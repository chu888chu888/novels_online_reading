<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: amf.php 2504 2011-12-28 07:35:29Z liu21st $

// AMF模式定义文件
return array(
    'core'         =>   array(
        THINK_PATH.'Common/functions.php',   // 系统函数库
        CORE_PATH.'Core/Log.class.php',// 日志处理
        MODE_PATH.'Amf/App.class.php', // 应用程序类
        MODE_PATH.'Amf/Action.class.php',// 控制器类
    ),

    // 项目别名定义文件 [支持数组直接定义或者文件名定义]
    'alias'         =>    array(
        'Model'         =>   MODE_PATH.'Amf/Model.class.php',
        'Db'                  =>    MODE_PATH.'Amf/Db.class.php',
    ), 

    // 系统行为定义文件 [必须 支持数组直接定义或者文件名定义 ]
    'extends'    =>    array(), 

    // 项目应用行为定义文件 [支持数组直接定义或者文件名定义]
    'tags'         =>   array(), 
);