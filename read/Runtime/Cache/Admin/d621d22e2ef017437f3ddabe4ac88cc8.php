<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/reset-min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/common.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/read/login.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>

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




.main .user {
font-size:12px;
background: #E8ECEC;
height:200px;
padding-top:70px;

}
.main .user li {
	float:left;
	width:124px;
	text-align:center;
	border:1px solid #fff;
    padding:5px;
}
.main .user li a:hover{
   cursor:pointer;
}

#userName,#userPass{
    width:100px;
    text-align:center;
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
        <ul class="selected"><a href="__URL__/../user">用户管理</a></ul>
        <ul><a href="__URL__/../novelCheckup">小说审核</a></ul>
        <ul><a href="__URL__/../class_Manager">分类管理</a></ul>
        <ul>其他杂项</ul>
        <ul><a href="__URL__/../author">作者功能</a></ul>
    </div>
   
    <ul class="user">
        <li>名称</li>
        <li>密码</li>
        <li>类型</li>
        <li>状态</li>
        <li>管理</li>
        
        <?php if(is_array($User)): $i = 0; $__LIST__ = $User;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="Listrecord">
        <li>
        	<?php if(($vo['state'] == 0) ): ?><span style="color:red;"><?php echo ($vo["userName"]); ?></span>
			<?php else: ?><span style="color:#76AD4E;"><?php echo ($vo["userName"]); ?></span><?php endif; ?>
        </li>
        <li>********</li>
        <li>
        	<?php if(($vo['userType'] == 2) ): ?>管理员
        	<?php elseif(($vo['userType'] == 1) ): ?>作者
			<?php else: ?>会员<?php endif; ?>
        </li>
        <li>
        	<?php if(($vo['state'] == 0) ): ?>待审核
			<?php else: ?>已审核[Pass]<?php endif; ?>
        </li>
        <li><a class="editUser"  href="__URL__/../edit_user?id=<?php echo ($vo["id"]); ?>"  >编辑</a> / <a href="__URL__/del/id/<?php echo ($vo["id"]); ?>" >删除</a>
	        <?php if(($vo['state'] == 0) ): ?>/ <a href="__URL__/checkup/id/<?php echo ($vo["id"]); ?>">审核</a>
			<?php elseif(($vo['userType'] == 0) ): ?>/ <a  href="__URL__/checkupAuthorYes/id/<?php echo ($vo["id"]); ?>">设为作者</a>
            <?php elseif(($vo['userType'] == 1) ): ?>/ <a  href="__URL__/checkupAuthorNo/id/<?php echo ($vo["id"]); ?>">撤销作者</a>
            <?php else: endif; ?>
		</li>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <form id="form1" name="form1" action="__URL__/add" method="post" >
        <li><input id="userName" name="userName" type="text" /></li>
        <li><input id="userPass" name="userPass" type="text" /></li>
        <li>
            <select name="userType">
            <option value="2">管理员</option><option value="1">作者</option><option value="0">注册用户</option>
            </select>
        </li>
        <li>
            <select name="state">
            <option value="1">已审核</option><option value="0">待审核</option>
            </select>
        </li>
        <li><input type="submit" value="添加"></input></li>
        </form>
    </ul>

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