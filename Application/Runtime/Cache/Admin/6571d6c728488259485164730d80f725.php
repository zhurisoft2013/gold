<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>用户信息修改</title>
	<!-- Favicons --> 
	<link rel="shortcut icon" type="image/png" HREF="/gold/Public/img/favicons/favicon.png"/>
	<link rel="icon" type="image/png" HREF="/gold/Public/img/favicons/favicon.png"/>
	<link rel="apple-touch-icon" HREF="/gold/Public/img/favicons/apple.png" />
	<!-- Main Stylesheet --> 
	<link rel="stylesheet" type="text/css" href="/gold/Public/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/gold/Public/css/admin.css" />
	<!-- Your Custom Stylesheet --> 
	
		<link rel="stylesheet" type="text/css" href="/gold/Public/css/custom.css" />
		
	
	<!-- jQuery with plugins -->
	<script type="text/javascript" src="/gold/Public/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/gold/Public/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/gold/Public/js/messages_zh.js"></script>
	<script type="text/javascript" src="/gold/Public/js/gotop.js"></script>
	<script type="text/javascript" src="/gold/Public/js/layer/layer.min.js"></script>
	<script>
	$(function(){
		var pwd_url="<?php echo U('Admin/User/changePWD');?>";
		var reg_url="<?php echo U('User/reg');?>";
		var addbookname_url="<?php echo U('Admin/Book/addName');?>";
		var updbook_url="<?php echo U('Admin/Book/edit','','');?>";
		layer.use('extend/layer.ext.js');
		$('#change_pwd').click(function(){
			$.layer({
				type : 2,

				title : ['修改密码',true],
				iframe : {src : pwd_url},
				area : ['500px' , '240px'],
				offset : ['150px', ''],

			});
		});

	})
	</script>
	

	<script>

	$(function(){
 		$('ul.role input:checkbox').click(function(event){
			// event.stopPropagation();
			// event.preventDefault();
			// alert($(this).val());
 			//$(this).parent().parent().parent().parent().find(':checkbox').attr("checked","checked");

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

	<div class="container">
		<header class="top clearfix">
			<a href="#" class="logo" title="黄金珠宝知识数据库管理平台"></a>
			
				<nav class="navs">
					<a href="/gold/index.php/Admin/User">主页</a>
				</nav>
			
			<!--
			<form action="" class="topfrm">
				<input type="text" name="search" id="">
				<input type="submit" value="搜索">
			</form>
			-->
			
				<ul class="info">
					<!--<li><a href="javascript:;" id="user_reg">用户注册</a></li>
					<li><a href="#">个人设置</a></li>-->
					<li class="login-info"><span class="username"><?php echo (session('username')); ?></span>，您好！</li>
					<li><a href="#" id="change_pwd">修改密码</a></li>
					<li><a href="#">获得帮助</a></li>
					<li><a href="<?php echo U('Admin/Login/logout');?>">退出系统</a></li>
				</ul>
			

		</header>
		<section class="main clearfix">
			<aside class="sidebar1">
				
				<dl class="menu">
					<dt>文章管理</dt>
					<dd><a href="<?php echo U('Admin/Article/index');?>"><em class="menu-icon icon-list"></em>文章列表</a></dd>
					<dd><a href="<?php echo U('Admin/Article/add');?>"><em class="menu-icon icon-plus"></em>添加文章</a></dd>
					<?php if(($_SESSION['username']) == "admin"): ?><dt>分类管理</dt>
					<dd><a href="<?php echo U('Admin/Category/index');?>"><em class="menu-icon icon-list"></em>分类列表</a></dd>
					<dd><a href="<?php echo U('Admin/Category/add');?>"><em class="menu-icon icon-plus"></em>添加分类</a></dd>
					<dt>用户管理</dt>
					<dd><a href="<?php echo U('Admin/User/index');?>"><em class="menu-icon icon-list"></em>用户列表</a></dd>
					<dd><a href="<?php echo U('Admin/User/add');?>"><em class="menu-icon icon-plus"></em>添加用户</a></dd>
					<dt>附件管理</dt>
					<dd><a href="<?php echo U('Admin/Attachment/index');?>"><em class="menu-icon icon-list"></em>附件列表</a></dd><?php endif; ?>						
<!-- 					<dt>系统设置</dt>
<dd><a href="<?php echo U('Admin/System/uploadSet');?>"><em class="menu-icon icon-list"></em>上传设置</a></dd> -->

<!-- 					<dt>留言管理</dt>
<dd><a href="<?php echo U('Admin/Message/index');?>"><em class="menu-icon icon-list"></em>留言列表</a></dd> -->
					<!--		
					<dt>附件管理</dt>
					<dd><a href="<?php echo U('Admin/Attachment/index');?>"><em class="menu-icon icon-list"></em>附件列表</a></dd>
					<dt>上传管理</dt>
					<dd><a href="<?php echo U('Admin/Upload/index');?>"><em class="menu-icon icon-circle-arrow-up"></em>上传测试</a></dd>
					

					
					<dt>分类管理</dt>
					<dd><a href="#"><em class="menu-icon icon-list"></em>分类列表</a></dd>
					<dd><a href="#"><em class="menu-icon icon-plus"></em>添加分类</a></dd>
					<dt>系统设置</dt>		
					<dd><a href="<?php echo U('Admin/System/uploadSet');?>"><em class="menu-icon icon-wrench"></em>上传设置</a></dd>
					-->		
				</dl>
				
			</aside>
			<section class="content">
				
	<div class="FormWrap">
		<h3>用户信息编辑</h3>
		<div class="division">
			<form action="<?php echo U('Admin/User/update');?>" method="post" id="frmEditUser">
				<table class="liststyle data" width="100%">
					<tbody>
						<tr>
							<th>登录名</th>
							<td>
								<strong> <?php echo ($user["username"]); ?></strong>
								<input type="hidden" name="id" value="<?php echo ($user["id"]); ?>" />
							</td>
						</tr>
						<tr>
							<th>昵称</th>
							<td>
								<input type="text" name="nickname" id="nickname" value="<?php echo ($user["nickname"]); ?>" />
							</td>
						</tr>
								
						<tr>
							<th>状态</th>
							<td>
								<select name="status" id="status" >
									<option value="1" 
									<?php if(($user['status']) == "1"): ?>selected="selected"<?php endif; ?>
									>正常</option>
									<option value="0" 
									<?php if(($user['status']) == "0"): ?>selected="selected"<?php endif; ?>
									>锁定</option>
									
								</select>
	
							</td>
						</tr>
						<tr>
							<th>管理模块</th>
							<td>
								<ul class="role">
									<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
									<label><input type="checkbox" name="role[]" id="" value="<?php echo ($vo["id"]); ?>" 
									<?php if(in_array(($vo['id']), is_array($role)?$role:explode(',',$role))): ?>checked="checked"<?php endif; ?>
									/><?php echo ($vo["title"]); ?></label>
									<?php if(!empty($vo['child'])): ?><ul><?php endif; ?>
									<?php if(is_array($vo['child'])): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><label><input type="checkbox" name="role[]" id="" value="<?php echo ($v["id"]); ?>" 
										<?php if(in_array(($v['id']), is_array($role)?$role:explode(',',$role))): ?>checked="checked"<?php endif; ?>
										/><?php echo ($v["title"]); ?></label>
										<?php if(!empty($v['child'])): ?><ul><?php endif; ?>
											<?php if(is_array($v['child'])): $i = 0; $__LIST__ = $v['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><li><label><input type="checkbox" name="role[]" id="" value="<?php echo ($v1["id"]); ?>" 
												<?php if(in_array(($v1['id']), is_array($role)?$role:explode(',',$role))): ?>checked="checked"<?php endif; ?>
												/><?php echo ($v1["title"]); ?></label></li><?php endforeach; endif; else: echo "" ;endif; ?>
										<?php if(!empty($v['child'])): ?></ul><?php endif; ?>
										</li><?php endforeach; endif; else: echo "" ;endif; ?>
									<?php if(!empty($vo['child'])): ?></ul><?php endif; ?>
									</li><?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>

							</td>
						</tr>						

						<tr>
							<td colspan="2" class="ta-center">
								<input type="submit" value="保存添加" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>

			</section>
		</section>


	</div>

	<!-- Scroll to top link -->
	<a href="#" id="totop"> </a>
</body>

</html>