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
// $Id: CacheMemcache.class.php 2728 2012-02-12 04:12:51Z liu21st $

/**
 +-------------------------------------
 * Memcache缓存驱动类
 +-------------------------------------
 */
class CacheMemcache extends Cache {

    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    function __construct($options='') {
        if ( !extension_loaded('memcache') ) {
            throw_exception(L('_NOT_SUPPERT_').':memcache');
        }
        if(empty($options)) {
            $options = array (
                'host'  => C('MEMCACHE_HOST') ? C('MEMCACHE_HOST') : '127.0.0.1',
                'port'  => C('MEMCACHE_PORT') ? C('MEMCACHE_PORT') : 11211,
                'timeout' => C('DATA_CACHE_TIMEOUT') ? C('DATA_CACHE_TIMEOUT') : false,
                'persistent' => false,
                'expire'   =>C('DATA_CACHE_TIME'),
                'length'   =>0,
            );
        }
        $this->options =  $options;
        $func = $options['persistent'] ? 'pconnect' : 'connect';
        $this->handler  = new Memcache;
        $this->connected = $options['timeout'] === false ?
            $this->handler->$func($options['host'], $options['port']) :
            $this->handler->$func($options['host'], $options['port'], $options['timeout']);
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
        N('cache_read',1);
        return $this->handler->get($name);
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
    public function set($name, $value, $expire = null) {
        N('cache_write',1);
        if(is_null($expire)) {
            $expire  =  $this->options['expire'];
        }
        if($this->handler->set($name, $value, 0, $expire)) {
            if($this->options['length']>0) {
                // 记录缓存队列
                $this->queue($name);
            }
            return true;
        }
        return false;
    }

    /**
     +----------------------------------------------------------
     * 删除缓存
     *
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $name 缓存变量名
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function rm($name, $ttl = false) {
        return $ttl === false ?
            $this->handler->delete($name) :
            $this->handler->delete($name, $ttl);
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
        return $this->handler->flush();
    }
}