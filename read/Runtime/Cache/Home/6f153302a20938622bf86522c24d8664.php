<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的阅读器</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/reset-min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/common.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/lib.css" />
</head>
<style type="text/css">
.bookcontent{
  font-size:16px;
  line-height:30px;
}
.bookcontent p{
  text-indent:2em;
  color: #555;
}
</style>
<body>
<div class="head">
  <div class="navigation">
      <h1 class="logo"><a href="/" title="小说阅读网"> 小说阅读网 </a></h1>
        <div class="link-to-book-store"><a href="/store/"> 更多小说作品 </a></div>
        <div class="session">
          <a href="http://www.douban.com/people/48661946/" target="_blank"> #铁王 </a>
            <a class="log-out" href="/logout?ck=awBr"> [退出] </a>
            
            </div>
    </div>
</div>
<?php if(is_array($bookcontents)): $i = 0; $__LIST__ = $bookcontents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="library-heading" >
  <div class="header">
        <ul class="library-filter-tabs">
            <li class="tab" >
                <h2>-><?php echo ($vo["contentName"]); ?></h2>
           </li>
        </ul>
    </div>  
</div>
<ol class="bookshelf bookcontent" >
    <?php echo ($vo["contents"]); ?> 
</ol><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="footer">
  <p class="copyright"> © 2005 - 2012 douban.com, all rights reserved. </p>
    <ul class="footer-nav">
      <li><a href="/contact"> 联系我们 </a></li><li><a href="/copyright"> 版权声明 </a></li>
        <li><a href="http://book.douban.com/help/ask?type=39"> 使用反馈 </a></li>
    </ul>
</div>
</body>
</html>