<?php
return array(
	//'配置项'=>'配置值'

	 /* 数据库设置 */
	 'DB_TYPE'               => 'mysql',     // 数据库类型
	'DB_HOST'               => 'localhost', // 服务器地址
	'DB_NAME'               => 'read_novel',          // 数据库名
	'DB_USER'               => 'root',      // 用户名
	'DB_PWD'                => 'root',          // 密码
	'DB_PORT'               => '3306',        // 端口
	'DB_PREFIX'             => '',    // 数据库表前缀

     /* 默认设定 */
    //'DEFAULT_THEME'    => 'default',	// 默认模板主题名称
    'DEFAULT_GROUP'         => 'Home',  // 默认分组

    /* URL设置 */
	'URL_CASE_INSENSITIVE'  => true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'             => 2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持
    'URL_PATHINFO_DEPR'     => '/',	// PATHINFO模式下，各参数之间的分割符号
    'URL_HTML_SUFFIX'       => '.html',  // URL伪静态后缀设置

    /*页面Trace信息*/
    'SHOW_PAGE_TRACE' => false,

     /* 项目设定 */
    'APP_GROUP_LIST'        => 'Home,Admin,Author',      // 项目分组设定,多个组之间用逗号分隔,例如'Home,Admin'
	
);
?>