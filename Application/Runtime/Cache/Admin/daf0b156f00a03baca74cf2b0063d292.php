<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>修改密码</title>
	<!-- Favicons --> 
	<link rel="shortcut icon" type="image/png" HREF="/gold/Public/img/favicons/favicon.png"/>
	<link rel="icon" type="image/png" HREF="/gold/Public/img/favicons/favicon.png"/>
	<link rel="apple-touch-icon" HREF="/gold/Public/img/favicons/apple.png" />
	<!-- Main Stylesheet --> 
	<link rel="stylesheet" type="text/css" href="/gold/Public/css/style.css" />

	<!-- Your Custom Stylesheet --> 
	

	
	<!-- jQuery with plugins -->
	<script type="text/javascript" src="/gold/Public/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/gold/Public/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/gold/Public/js/messages_zh.js"></script>
	<script type="text/javascript" src="/gold/Public/js/gotop.js"></script>
	<script type="text/javascript" src="/gold/Public/js/layer/layer.min.js"></script>
	<script>
	$(function(){
/*		var pwd_url="<?php echo U('Admin/User/changePWD');?>";
		$('#change_pwd').click(function(){
			$.layer({
				type : 2,

				title : ['修改密码',true],
				iframe : {src : pwd_url},
				area : ['500px' , '260px'],
				offset : ['150px', ''],
				close : function(index){
					// layer.msg('您获得了子窗口标记：' + layer.getChildFrame('#name', index).val(),3,1);
					// layer.close(index);
				}
			});
		

		});*/
	})
	</script>
	
	<script>
	$(function(){
		var url="<?php echo U('Admin/User/savePWD');?>";
		var index = parent.layer.getFrameIndex(window.name);

		
		$('#save').click(function(){
			var orgpwd=$('#frmChangePWD input[name=orgpwd]').val();
			var newpwd=$('#frmChangePWD input[name=newpwd]').val();
			var repwd=$('#frmChangePWD input[name=repwd]').val();
			// alert(orgpwd+newpwd+repwd);
			if (newpwd!=repwd) {
				alert('密码与确认密码不一致！')
				$('#frmChangePWD input[name=newpwd]').focus();
				return false;
			};
			$.post(url,{orgpwd:orgpwd,newpwd:newpwd,repwd:repwd},function(data){
				if (data.status==1) {
					alert('密码修改成功');
					parent.layer.close(index);

				}else{
					alert(data.info);
				}
			})
		})
	})
	</script>
	
	
	<!-- Internet Explorer Fixes --> 
	<!--[if IE]>
	<link rel="stylesheet" type="text/css" media="all" href="/gold/Public/css/ie.css"/>
	<script src="/gold/Public/js/html5.js"></script>
	<![endif]-->
	<!--Upgrade MSIE5.5-7 to be compatible with MSIE8: http://ie7-js.googlecode.com/svn/version/2.1(beta3)/IE8.js -->
	<!--[if lt IE 8]>
	<script src="/gold/Public/js/IE8.js"></script>
	<![endif]-->
</head>
<body>





			<section class="content">
				
	<div class="FormWrap">
			<form action="" method="post" id="frmChangePWD">
				<table class="liststyle data" width="100%">
					<tr>
						<th>原密码</th>
						<td>
							<input type="password" name="orgpwd" />
						</td>
					</tr>
					<tr>
						<th>新密码</th>
						<td>
							<input type="password" name="newpwd" />
						</td>
					</tr>
					<tr>
						<th>确认密码</th>
						<td>
							<input type="password" name="repwd" />
						</td>
					</tr>
					<tr>
						<td colspan="2" class="ta-center">
							<input type="button" value="保存" id="save" class="btn btn-blue" />
						</td>
					</tr>
				</table>
			</form>

	</div>

			</section>





	<!-- Scroll to top link -->
	<a href="#" id="totop"> </a>
</body>

</html>