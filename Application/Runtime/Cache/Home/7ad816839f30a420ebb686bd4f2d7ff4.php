<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>真人图书馆-图书展示</title>
	<link rel="stylesheet" type="text/css" href="/library/Public/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/library/Public/css/front.css" />

	
	<script type="text/javascript" src="/library/Public/js/jquery-1.11.0.min.js"></script>

	

</head>
<body>
	<div id="header">
		<h1><a href="/library">罗湖区图书馆-真人图书馆</a></h1>
		<div class="search">
			<form method="post" action="<?php echo U('Home/Index/search');?>">
				<span class="inp"><input type="text" autocomplete="off" name="q" placeholder="姓名，爱好，" size="12" maxlength="60"></span>
				<span class="bn"><input type="submit" value="搜索"></span>
			</form>			
		</div>

	</div>
	<div id="sep">
		<div class="wrapper">
			<div class="login">
			    <form action="#" method="post" name="lzform" id="lzform">
			        <fieldset>
			            <legend>登录</legend>
			             <div class="item item-account">
			                <input type="text" tabindex="1" placeholder="借书证号" class="inp" value="" id="form_email" name="form_email">
			            </div>
			            <div class="item item-passwd">
			                <input type="password" tabindex="2" class="inp" id="form_password" placeholder="密码" name="form_password">
			               <div class="item-submit">
			                <input type="submit" tabindex="4" class="bn-submit" value="登录">
			            </div>
			        </fieldset>
			    </form>

		</div>

	   </div>	

	</div>
	<div class="section">
		<div class="wrapper second">

			<div class="sidebar1">
				
				<h2>分类</h2>
				<ul>
					<li><a href="<?php echo U('Home/Index/getBookByCategory',array('cid'=>1));?>">教育类</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByCategory',array('cid'=>2));?>">娱乐类</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByCategory',array('cid'=>3));?>">科技类</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByCategory',array('cid'=>4));?>">生活类</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByCategory',array('cid'=>5));?>">体育类</a></li>
 				</ul>
 				<h2>热门标签</h2>
				<ol>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>1));?>">旅游</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>9));?>">家族</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>8));?>">游戏</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>7));?>">音乐</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>6));?>">回忆录</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>5));?>">电影</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>4));?>">家居</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>3));?>">健康</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>2));?>">职场</a></li>
					<li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>10));?>">文学</a></li>	
				</ol>

 				
			</div>
			<div class="main">
				<div class="mod mheight">
					
    <div class="result">
        <h3>搜索结果</h3>
        <ul>
        <?php if(is_array($book)): $i = 0; $__LIST__ = $book;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                <a href="<?php echo U('Home/Index/bookShow',array('id'=>$vo['id']));?>"><img src="<?php echo ($vo["photo"]); ?>" alt="<?php echo ($vo["bookname"]); ?>"  class="avatar" /></a>
                <div class="result-header">
                    <a href="<?php echo U('Home/Index/bookShow',array('id'=>$vo['id']));?>"><span class="bookname"><?php echo ($vo["summary"]); ?></span></a>
                </div>
                <div class="result-content">
                <p><?php echo ($vo["bookname"]); ?> / <?php if(($vo["sex"]) == "1"): ?>男<?php else: ?>女<?php endif; ?> / <?php echo (date("Y年m月d日",$vo["time"])); ?>  / <?php echo ($vo["university"]); echo ($vo["edu_name"]); ?>毕业 / <?php echo ($vo["category"]); ?> / <?php echo ($vo["skill"]); ?> /
                <?php if(is_array($vo["tag"])): foreach($vo["tag"] as $key=>$v): echo ($v["tag_name"]); ?>&nbsp;<?php endforeach; endif; ?>
                 /  <?php echo ($vo["resume"]); ?> </p>
                </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
	
				</div>
			</div>
		</div>
	</div>


	<div class="wrapper">
	  <div id="ft">
	<span class="fleft gray-link" id="icp">
	    &copy; 2014 逐日软件, all rights reserved
	  <br>
	 
	</span>

	<span class="fright">
	    <a href="#">关于真人图书馆</a>
	    · <a href="#">联系我们</a>	    
	    · <a href="#">帮助中心</a>
	    · <a target="_blank" href="#">开发者</a>

	</span>


	  </div>
	</div>
	</body>
	</html>