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
    $(".main .menu ul:eq(1)").addClass("selected")
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
.main #addBook {
	width:680px;
	text-align:left;
	line-height:50px;
	padding-top:50px;
}

.main .book {
font-size:12px;
background: #E8ECEC;
height:200px;
padding-top:70px;

}
.main .book li {
  float:left;
  width:300px;
  text-align:center;
  border:1px solid #fff;
    padding:5px;
}
.main .book li a:hover{
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
        <ul > <a href="__URL__/../add_Novel">添加新作</a></ul>
        <ul > <a href="__URL__/../novel_List">我的作品</a></ul>     
 </div>
    
     <ul class="book">
        <li>书名</li>
        <li>管理</li>
   		 			<?php if(is_array($books)): $i = 0; $__LIST__ = $books;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($vo["bookTitle"]); ?></li>
              <li><a href="__URL__/../content_list?id=<?php echo ($vo["id"]); ?>">章节管理</a> / <a href="__URL__/../add_Content?id=<?php echo ($vo["id"]); ?>">添加章节</a> / <a href="__URL__/../novel_edit?id=<?php echo ($vo["id"]); ?>">编辑本书信息</a> / <a href="__URL__/del/id/<?php echo ($vo["id"]); ?>">删除本书</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
   	</ul> 

</div>

<div class="footer">
  <p class="copyright"> © 2012 - ?  小说阅读网, 版权所有. </p>
    <ul class="footer-nav">
      <li><a href="#"> 联系我们 </a></li><li><a href="#"> 版权声明 </a></li>
        <li><a href="#"> 使用反馈 </a></li>
    </ul>
</div>
</body>
</html>