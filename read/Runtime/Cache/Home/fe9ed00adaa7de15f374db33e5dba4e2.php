<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>小说阅读网</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/read/reset-min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/read/common.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/read/novel.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript">
$(function(){
  
      //如果。icona-dded[表现为已经被加入书签]  其后有同辈元素，则隐藏他
      $(".icon-added").next( "a").remove();

      $(".article-desc-brief .view-detail-context .view-detail").click(function(){
        $(this).parent().parent(".article-desc-brief").hide();
        $(this).parent().parent(".article-desc-brief").next().show();
      })

      $(".article-desc-full .view-detail-context .view-detail").click(function(){
       $(this).parent().parent(".article-desc-full").hide();
        $(this).parent().parent().prev(".article-desc-brief").show();
         
      })



})
</script>
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
                <h2>全体小说起立</h2>
           </li>
        </ul>
    </div>	
</div>
<ol class="article" >
<?php if(is_array($books)): $i = 0; $__LIST__ = $books;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div  class="item">
      <div class="cover">
          

<div class="pic cover-renderer" style="background: url(__PUBLIC__/Images/read/books/coverDemo.jpg);
  color: white">
  <span class="cover-rendered-text"></span>
</div>

      </div>
      <div class="info">
          <h3 class="title"><?php echo ($vo["bookTitle"]); ?></h3>
          <div class="article-actions">
           

            <?php if(is_array($booklib)): foreach($booklib as $key=>$vo1): if(( $vo["id"] == $vo1["bookId"] )): ?>已加入阅读列表<span class="icon-added"></span>   
                <?php else: endif; endforeach; endif; ?>
            <a  class="purchase btn-compact bookList" href="__URL__/add/bookId/<?php echo ($vo["id"]); ?>">加入阅读列表</a>



            
          </div>

        

          <p>
              <span class="author" bookAuthorId=<?php echo ($vo["bookAuthorId"]); ?>>
                  作者：<?php echo ($vo["authorName"]); ?>
              </span>
          </p>
          <div class="article-desc-brief">
              <p class="abstract"><?php echo ($vo["bookDescribe"]); ?></p>
              <p class="view-detail-context">
                  <a class="view-detail" href="javascript:;">查看详细信息</b></a>
              </p>
          </div>
          <div class="article-desc-full">
            <p><?php echo ($vo["bookDescribe"]); ?></p>
            
              
            
            <p class="view-detail-context"><a class="view-detail" href="javascript:;">收起</a></p>
          </div>
      </div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
  
  
  
  
  
  
  
  
    
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