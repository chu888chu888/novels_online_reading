<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的阅读器</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/reset-min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/common.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/lib.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery/jquery.js"></script>
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

.backToTop {
    display: none;
    width: 18px;
    line-height: 1.2;
    padding: 5px 0;
    background-color: #000;
    color: #fff;
    font-size: 12px;
    text-align: center;
    position: fixed;
    _position: absolute;
    right: 10%;
    bottom: 100px;
    _bottom: "auto";
    cursor: pointer;
    opacity: .6;
    filter: Alpha(opacity=60);
}
</style>
<body>
<div class="head">
	<div class="navigation">
    	<h1 class="logo"><a href="__APP__/" title="小说阅读网"> 小说阅读网 </a></h1>
        <!--<div class="link-to-book-store"><a href="/store/"> 更多小说作品 </a></div>-->
        <div class="session">
        	<a href="__URL__/../Libary" > <?php echo ($userName); ?> </a>
            <a class="log-out" href="__URL__/../logout"><?php echo ($logout); ?> </a>
            
            </div>
    </div>
</div>
<?php if(is_array($bookcontents)): $i = 0; $__LIST__ = $bookcontents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="library-heading" >
  <div class="header">
        <ul class="library-filter-tabs">
            <li class="tab" >
                <h2><?php echo ($bookName); ?>-><h3><?php echo ($vo["contentNum"]); ?>.<?php echo ($vo["contentName"]); ?></h3></h2>
           </li>
        </ul>
    </div>  
</div>
<ol class="bookshelf bookcontent" >
    <?php echo ($vo["contents"]); ?> 
    <p style="text-indent:0; border-top:1px solid #ccc;">
     <?php if(($contentId == 1)): ?><a  style="float:left;">文首</a>

    <?php else: ?><a href="__URL__/read/<?php echo ($bookId); ?>/<?php echo ($contentId-1); ?>" style="float:left;">上一章</a><?php endif; ?>
      <?php if(($contentId == $contentMax )): ?><a style="float:right;">文尾</a>
      <?php else: ?><a href="__URL__/read/<?php echo ($bookId); ?>/<?php echo ($contentId+1); ?>" style="float:right;">下一章</a><?php endif; ?>
      </p>
</ol><?php endforeach; endif; else: echo "" ;endif; ?>



<div class="footer">
  <p class="copyright"> © 2012 - ?  小说阅读网, 版权所有. </p>
    <ul class="footer-nav">
      <li><a href="#"> 联系我们 </a></li><li><a href="#"> 版权声明 </a></li>
        <li><a href="#"> 使用反馈 </a></li>
    </ul>
</div>
</body>
<script type="text/javascript">
    var $backToTopTxt = "返回顶部", $backToTopEle = $('<div class="backToTop"></div>').appendTo($("body"))
        .text($backToTopTxt).attr("title", $backToTopTxt).click(function() {
            $("html, body").animate({ scrollTop: 0 }, 120);
    }), $backToTopFun = function() {
        var st = $(document).scrollTop(), winh = $(window).height();
        (st > 0)? $backToTopEle.show(): $backToTopEle.hide();
        //IE6下的定位
        if (!window.XMLHttpRequest) {
            $backToTopEle.css("top", st + winh - 166);
        }
    };
    $(window).bind("scroll", $backToTopFun);
    $(function() { $backToTopFun(); });
</script>
</html>