<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/reset-min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/common.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/login.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript">
$(function(){
    $(".main .menu ul").click(function(){
        $(".main .menu ul").removeClass("selected")//清空添加的样式，初始化
        $(this).addClass("selected")
        
    })
})
</script>
<style type="text/css">
.main {
	width: 680px;
margin-left: auto;
margin-right: auto;
position: relative;
}
.main .menu {
    width: 680px;
    height:20px;
	font-size:14px;
	margin-top:1px;
	
}
.main .menu ul {
	width:112px;
	height:20px;
	text-align:center;
	float:left;
	background-color:#D4D8D8;
	margin-right:1px;
	color:#8A8A8A;
}
.main .menu .selected {
	color:#79acdc;
    background-color:#efefef;
}
.main .menu ul:hover {
	background-color:#efefef;
	cursor:pointer;

}
.main .WelCome {
	width:680px;
	text-align:center;
	line-height:100px;
}



.main .user {
font-size:12px;
background: #E8ECEC;
height:400px;

}
.main .user li {
	float:left;
	width:157px;
	text-align:center;
	border:1px solid #fff;
    padding:5px;
}
.main .user li a:hover{
   cursor:pointer;
}
</style>
</head>

<body>
<div class="head">
    <div class="navigation">
        <h1 class="logo"><a href="__APP__/" title="小说阅读网"> 小说阅读网 </a></h1>
        <div class="link-to-book-store"><a href="javascript:;"> 后台管理系统 </a></div>
        <div class="session">
            <a href="http://www.douban.com/people/48661946/" target="_blank"> <?php echo ($userName); ?> </a>
            <a class="log-out" href="__URL__/../logout"> <?php echo ($logout); ?> </a>
       </div>
    </div>
</div>
</div>

<div class="main">
    <div class="menu">
        <ul> <a href="__URL__/../cfg">网站配置</a></ul>
        <ul ><a href="__URL__/../user">用户管理</a></ul>
        <ul><a href="__URL__/../novelCheckup">小说审核</a></ul>
        <ul><a href="__URL__/../classManager">分类管理</a></ul>
        <ul>其他杂项</ul>
        <ul><a href="__URL__/../author">作者功能</a></ul>
    </div>
    <p class="WelCome" >欢迎使用</p>
    

</div>

<div class="footer">
  <p class="copyright"> © 2005 - 2012 douban.com, all rights reserved. </p>
    <ul class="footer-nav">
      <li><a href="/contact"> 联系我们 </a></li><li><a href="/copyright"> 版权声明 </a></li>
        <li><a href="http://book.douban.com/help/ask?type=39"> 使用反馈 </a></li>
    </ul>
</div>
</body>
</html>