<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的阅读器</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/reset-min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/common.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/lib.css" />
</head>

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
<div class="library-heading" >
  <div class="header">
        <ul class="library-filter-tabs">
            <li class="tab" >
                <h2> <?php echo ($userName); ?>的阅读列表</h2>
           </li>
        </ul>
    </div>  
</div>
<ol class="bookshelf" >

 <?php if(is_array($mybooks)): foreach($mybooks as $key=>$vo): ?><li class="article-item">
      <a data-permalink="" href="__URL__/../ebook/read/<?php echo ($vo["bookId"]); ?>/<?php echo ($vo["contentId"]); ?>">
          <img class="article-item-media" src="__PUBLIC__/Images/read/books/coverDemo.jpg" width="76" height="113">
            <div class="article-item-content">
              <h3> <?php echo ($vo["bookTitle"]); ?> </h3>
              <div class="author"> <?php echo ($vo["authorName"]); ?></div>  
                <div class="reading-progress">  
                  <span class="progress-positive-dots progress-dots">
                      

                        <?php $__FOR_START__=1;$__FOR_END__=$vo[contentId]/$vo[maxContentId]*10;for($i=$__FOR_START__;$i < $__FOR_END__;$i+=1){ ?>●<?php } ?></span>
                    <span class="progress-negative-dots progress-dots">
                     <?php $__FOR_START__=1;$__FOR_END__=11-$vo[contentId]/$vo[maxContentId]*10;for($i=$__FOR_START__;$i < $__FOR_END__;$i+=1){ ?>•<?php } ?></span>
                    <span class="progress-number"><?php echo ($vo["contentId"]); ?>/<?php echo ($vo["maxContentId"]); ?>章 </span>  
               </div>
               <div class="article-item-meta">
                  <div class="article-published-date">  发布时间 <?php echo ($vo["addTime"]); ?>  </div>
                    <div class="impression">
                      
                        <div class="impression-numbers">  
      <span class="review-count"> 共 <span class="review-num"> 396 </span> 评论 </span>  </div></div>

        <div class="impression">
                      
                        <div class="impression-numbers">  
                        <div class="article-published-date">  上次阅读  <?php echo ($vo["lastTime"]); ?> </div>
     </div></div>


      </div></div></a>
  </li><?php endforeach; endif; ?>

     
    
</ol>

<div class="footer">
  <p class="copyright"> © 2012 - ?  小说阅读网, 版权所有. </p>
    <ul class="footer-nav">
      <li><a href="#"> 联系我们 </a></li><li><a href="#"> 版权声明 </a></li>
        <li><a href="#"> 使用反馈 </a></li>
    </ul>
</div>
</body>
</html>