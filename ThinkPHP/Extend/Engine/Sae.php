<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: Sae.php 2793 2012-03-02 05:34:40Z liu21st $
// Sae版ThinkPHP 入口文件
//[sae]定义SAE_PATH
defined('ENGINE_PATH') or define('ENGINE_PATH',dirname(__FILE__).'/');
define('SAE_PATH', ENGINE_PATH.'Sae/');
//[sae]判断是否运行在SAE上。
if (!isset($_SERVER['HTTP_APPCOOKIE'])) {
    define('IS_SAE', FALSE);
    defined('THINK_PATH') or  define('THINK_PATH', dirname(dirname(dirname(__FILE__))) . '/');
    defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . '/');
    //加载平滑函数
    require SAE_PATH.'Common/sae_functions.php';
    //加载模拟器
    if (!defined('SAE_APPNAME'))
        require SAE_PATH.'SaeImit.php';
    require THINK_PATH . 'ThinkPHP.php';
    exit();
}
define('IS_SAE', TRUE);
require SAE_PATH.'Lib/Core/SaeMC.class.php';
//记录开始运行时间
$GLOBALS['_beginTime'] = microtime(TRUE);
// 记录内存初始使用
define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
if (MEMORY_LIMIT_ON) $GLOBALS['_startUseMems'] = memory_get_usage();
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . '/');
//[sae] 判断是否手动建立项目目录
if (!is_dir(APP_PATH . '/Lib/')) {
    header('Content-Type:text/html; charset=utf-8');
    exit('<div style=\'font-weight:bold;float:left;width:430px;text-align:center;border:1px solid silver;background:#E8EFFF;padding:8px;color:red;font-size:14px;font-family:Tahoma\'>sae环境下请手动生成项目目录~</div>');
}
defined('RUNTIME_PATH') or  define('RUNTIME_PATH', APP_PATH . 'Runtime/');
defined('APP_DEBUG') or    define('APP_DEBUG', false); // 是否调试模式
$runtime = defined('MODE_NAME') ? '~' . strtolower(MODE_NAME) . '_runtime.php' : '~runtime.php';
defined('RUNTIME_FILE') or define('RUNTIME_FILE', RUNTIME_PATH . $runtime);
//[sae] 载入核心编译缓存
if (!APP_DEBUG && SaeMC::file_exists(RUNTIME_FILE)) {
    // 部署模式直接载入allinone缓存
    SaeMC::include_file(RUNTIME_FILE);
} else {
    // ThinkPHP系统目录定义
    defined('THINK_PATH') or  define('THINK_PATH', dirname(dirname(dirname(__FILE__))) . '/');
    //[sae] 加载运行时文件
    require SAE_PATH.'Common/runtime.php';
}