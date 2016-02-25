<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>黄金珠宝知识数据库管理平台-系统登录</title>
<meta name="description" content="系统登录" />
<meta name="keywords" content="系统,登录" />
<!-- Favicons --> 
<link rel="shortcut icon" type="image/png" HREF="/gold/Public/img/favicons/favicon.png"/>
<link rel="icon" type="image/png" HREF="/gold/Public/img/favicons/favicon.png"/>
<link rel="apple-touch-icon" HREF="/gold/Public/img/favicons/apple.png" />
<!-- Main Stylesheet --> 
<link rel="stylesheet" href="/gold/Public/css/style.css" type="text/css" />
<link rel="stylesheet" href="/gold/Public/css/page.css" type="text/css" />
<!-- Your Custom Stylesheet --> 
<link rel="stylesheet" href="/gold/Public/css/custom.css" type="text/css" />

<!-- jQuery with plugins -->
<script type="text/javascript" SRC="/gold/Public/js/jquery-1.11.0.min.js"></script>
<script src="/gold/Public/js/jquery.validate.min.js"></script>
<script src="/gold/Public/js/messages_zh.js"></script>

<!-- Internet Explorer Fixes --> 
<!--[if IE]>
<link rel="stylesheet" type="text/css" media="all" href="/gold/Public/css/ie.css"/>
<script src="/gold/Public/js/html5.js"></script>
<![endif]-->
<!--Upgrade MSIE5.5-7 to be compatible with MSIE8: http://ie7-js.googlecode.com/svn/version/2.1(beta3)/IE8.js -->
<!--[if lt IE 8]>
<script src="/gold/Public/js/IE8.js"></script>
<![endif]-->
<script type="text/javascript">
var URL='<?php echo U('Admin/Login/verify','','');?>/';
//专为firefox，后退刷新验证码
window.onpageshow=function(){
 	change_code();
 }
$(document).ready(function(){
	change_code();
	// validate signup form on keyup and submit
	var validator = $("#loginform").validate({
		rules: {
			username: "required",
			password: "required",
			code: "required"
		},
		messages: {
			username: "请输入用户名",
			password: "请输入你的密码",
			code: "请输入验证码",
		},
		// the errorPlacement has to take the layout into account
		errorPlacement: function(error, element) {
			error.insertAfter(element.parent().find('label:first'));
		},
		// set new class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("ok");
		}
	});


});
function change_code(){
		$('#imgCode').attr('src',URL+Math.random());
}
</script>
</head>
<body>
	<!-- Header -->
	<header id="top">
		<div class="wrapper-login">
			<!-- Title/Logo - can use text instead of image -->
			<div id="title"><img SRC="/gold/Public/images/title.png" alt="zhurisoft" /><!--<span>Administry</span> demo--></div>
		</div>
	</header>
	<!-- End of Header -->
	<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper-login"></div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper-login">
			<!-- Login form -->
			<section class="full">					
				
				<h3>登录系统</h3>
				<div class="box box-info">请输入下面的登录信息</div>
				<form id="loginform" method="post" action="<?php echo U('Admin/Login/check');?>">

					<p>
						<label class="required" for="username">用户名:</label><br/>
						<input type="text" id="username" class="full" value="" name="username"/>
					</p>
					
					<p>
						<label class="required" for="password">密码:</label><br/>
						<input type="password" id="password" class="full" value="" name="password"/>
					</p>

					<p>
						<label class="required" for="code">验证码:</label><br/>
						<p class="reset">
						<input type="text" id="code" class="half align-left" value="" name="code" /><img id="imgCode" src="<?php echo U('Admin/Login/verify','','');?>"  class="align-left" style="margin:0 6px;" /><a href="javascript:change_code();" class="align-right" style="padding:4px 2px;">看不清</a><br class="clearfloat" />
						</p>
					</p>
					<!--		
					<p>
						<input type="checkbox" id="remember" class="" value="1" name="remember"/>
						<label class="choice" for="remember">记住我?</label>
					</p>
					-->
					<p>
						<input type="submit" class="btn btn-green big" value="登录"/> <!--&nbsp; <a href="javascript: //;">忘记密码?</a>-->
					</p>
					<div class="clear">&nbsp;</div>

				</form>
				
			</section>
			<!-- End of login form -->
				
		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->
	
	<!-- Page footer -->
	<footer id="bottom">
		<div class="wrapper-login">
			<p>Copyright &copy; 2014 <b><a HREF="#" title="逐日软件">逐日软件</a></b> | Icons by <a HREF="#">zhurisoft</a></p>
		</div>
	</footer>
	<!-- End of Page footer -->

</body>
</html>