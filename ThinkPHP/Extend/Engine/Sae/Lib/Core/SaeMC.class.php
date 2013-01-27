<?php

/**
 * +---------------------------------------------------
 * | 对Memcache操作的封装，用于文件缓存
 * +---------------------------------------------------
 * @author luofei614<www.3g4k.com>
 */
if (!class_exists('SaeMC')) {

//[sae]对Memcache操作的封装，编译缓存，模版缓存存入Memcache中（非wrappers的形式）
    class SaeMC {

        static public $handler;
        static private $current_include_file = null;
        static private $contents = array();
        static private $filemtimes = array();

        //设置文件内容
        static public function set($filename, $content) {
            $time=time();
            self::$handler->set($_SERVER['HTTP_APPVERSION'] . '/' . $filename, $time . $content, MEMCACHE_COMPRESSED, 0);
            self::$contents[$filename]=$content;
            self::$filemtimes[$filename]=$time;
        }

        //载入文件
        static public function include_file($_filename,$_vars=null) {
            self::$current_include_file = 'saemc://' . $_SERVER['HTTP_APPVERSION'] . '/' . $_filename;
            $_content = isset(self::$contents[$_filename]) ? self::$contents[$_filename] : self::getValue($_filename, 'content');
            if(!is_null($_vars))
                extract($_vars, EXTR_OVERWRITE);
   
            if (!$_content)
                exit('<br /><b>SAE_Parse_error</b>: failed to open stream: No such file ' . self::$current_include_file);
            if (@(eval(' ?>' . $_content)) === false)
                self::error();
            self::$current_include_file = null;
            unset(self::$contents[$_filename]); //释放内存
        }

        static private function getValue($filename, $type='mtime') {
            $content = self::$handler->get($_SERVER['HTTP_APPVERSION'] . '/' . $filename);
            if (!$content)
                return false;
            $ret = array(
                'mtime' => substr($content, 0, 10),
                'content' => substr($content, 10)
            );
            self::$contents[$filename] = $ret['content'];
            self::$filemtimes[$filename] = $ret['mtime'];
            return $ret[$type];
        }

        //获得文件修改时间
        static public function filemtime($filename) {
            if (!isset(self::$filemtimes[$filename]))
                return self::getValue($filename, 'mtime');
            return self::$filemtimes[$filename];
        }

        //删除文件
        static public function unlink($filename) {
            if (isset(self::$contents[$filename]))
                unset(self::$contents[$filename]);
            if (isset(self::$filemtimes[$filename]))
                unset(self::$filemtimes[$filename]);
            return self::$handler->delete($_SERVER['HTTP_APPVERSION'] . '/' . $filename);
        }

        static public function file_exists($filename) {
            return self::filemtime($filename) === false ? false : true;
        }

        static function error() {
            $error = error_get_last();
            if (!is_null($error)) {
                $file = strpos($error['file'], 'eval()') !== false ? self::$current_include_file : $error['file'];
                exit("<br /><b>SAE_error</b>:  {$error['message']} in <b>" . $file . "</b> on line <b>{$error['line']}</b><br />");
            }
        }

    }

    register_shutdown_function(array('SaeMC', 'error'));
    //[sae] 初始化memcache
    if (!(SaeMC::$handler = @(memcache_init()))) {
        header('Content-Type:text/html; charset=utf-8');
        exit('<div style=\'font-weight:bold;float:left;width:430px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;color:red;font-size:14px;font-family:Tahoma\'>您的Memcache还没有初始化，请登录SAE平台进行初始化~</div>');
    }
}