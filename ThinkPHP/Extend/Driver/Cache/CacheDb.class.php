<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: CacheDb.class.php 2734 2012-02-14 06:55:15Z liu21st $

/**
 +-----------------------------------------------
 * 数据库类型缓存驱动类
     CREATE TABLE think_cache (
       cachekey varchar(255) NOT NULL,
       expire int(11) NOT NULL,
       data blob,
       datacrc int(32),
       UNIQUE KEY `cachekey` (`cachekey`)
     );
 +-----------------------------------------------
 */
class CacheDb extends Cache {

    /**
     +----------------------------------------------------------
     * 缓存数据库对象 采用数据库方式有效
     +----------------------------------------------------------
     * @var string
     * @access protected
     +----------------------------------------------------------
     */
    private $db     ;

    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function __construct($options='') {
        if(empty($options)){
            $options= array (
                'db'        => C('DB_NAME'),
                'table'     => C('DATA_CACHE_TABLE'),
                'expire'    => C('DATA_CACHE_TIME'),
                'length'    => 0,
            );
        }
        $this->options = $options;
        import('Db');
        $this->db  = DB::getInstance();
        $this->connected = is_resource($this->db);
    }

    /**
     +----------------------------------------------------------
     * 是否连接
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    private function isConnected() {
        return $this->connected;
    }

    /**
     +----------------------------------------------------------
     * 读取缓存
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $name 缓存变量名
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     */
    public function get($name) {
        $name  =  addslashes($name);
        N('cache_read',1);
        $result  =  $this->db->query('SELECT `data`,`datacrc` FROM `'.$this->options['table'].'` WHERE `cachekey`=\''.$name.'\' AND (`expire` =0 OR `expire`>'.time().') LIMIT 0,1');
        if(false !== $result ) {
            $result   =  $result[0];
            if(C('DATA_CACHE_CHECK')) {//开启数据校验
                if($result['datacrc'] != md5($result['data'])) {//校验错误
                    return false;
                }
            }
            $content   =  $result['data'];
            if(C('DATA_CACHE_COMPRESS') && function_exists('gzcompress')) {
                //启用数据压缩
                $content   =   gzuncompress($content);
            }
            $content    =   unserialize($content);
            return $content;
        }
        else {
            return false;
        }
    }

    /**
     +----------------------------------------------------------
     * 写入缓存
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $name 缓存变量名
     * @param mixed $value  存储数据
     * @param integer $expire  有效时间（秒）
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function set($name, $value,$expire=null) {
        $data   =   serialize($value);
        $name  =  addslashes($name);
        N('cache_write',1);
        if( C('DATA_CACHE_COMPRESS') && function_exists('gzcompress')) {
            //数据压缩
            $data   =   gzcompress($data,3);
        }
        if(C('DATA_CACHE_CHECK')) {//开启数据校验
            $crc  =  md5($data);
        }else {
            $crc  =  '';
        }
        if(is_null($expire)) {
            $expire  =  $this->options['expire'];
        }
        $expire	=	($expire==0)?0: (time()+$expire) ;//缓存有效期为0表示永久缓存
        $result  =  $this->db->query('select `cachekey` from `'.$this->options['table'].'` where `cachekey`=\''.$name.'\' limit 0,1');
        if(!empty($result) ) {
        	//更新记录
            $result  =  $this->db->execute('UPDATE '.$this->options['table'].' SET data=\''.$data.'\' ,datacrc=\''.$crc.'\',expire='.$expire.' WHERE `cachekey`=\''.$name.'\'');
        }else {
        	//新增记录
             $result  =  $this->db->execute('INSERT INTO '.$this->options['table'].' (`cachekey`,`data`,`datacrc`,`expire`) VALUES (\''.$name.'\',\''.$data.'\',\''.$crc.'\','.$expire.')');
        }
        if($result) {
            if($this->options['length']>0) {
                // 记录缓存队列
                $this->queue($name);
            }
            return true;
        }else {
            return false;
        }
    }

    /**
     +----------------------------------------------------------
     * 删除缓存
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $name 缓存变量名
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function rm($name) {
        $name  =  addslashes($name);
        return $this->db->execute('DELETE FROM `'.$this->options['table'].'` WHERE `cachekey`=\''.$name.'\'');
    }

    /**
     +----------------------------------------------------------
     * 清除缓存
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function clear() {
        return $this->db->execute('TRUNCATE TABLE `'.$this->options['table'].'`');
    }

}