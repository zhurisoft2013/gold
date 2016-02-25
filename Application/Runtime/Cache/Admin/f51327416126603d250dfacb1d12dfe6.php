<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>编辑分类</title>
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
			$("#cid").change(function(){
				if($("#cid").val()!=0){
					$("#showMenu").attr('checked',false);
					$("#menu").hide();	
				}else{
					// $("#showMenu").attr('checked',true);
					$("#menu").show();
				}
				
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
					<a href="/gold/index.php/Admin/Category">主页</a>
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
					<dt>数据统计</dt>
					<dd><a href="<?php echo U('Admin/Stat/user');?>"><em class="menu-icon icon-list"></em>用户统计</a></dd>
					<dd><a href="<?php echo U('Admin/Stat/category');?>"><em class="menu-icon icon-plus"></em>栏目统计</a></dd>
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
		<h3>修改分类</h3>
		<div class="division">
			<form action="<?php echo U('Admin/Category/update');?>" method="post" id="frmUpdCategory">
				<table class="liststyle data" width="100%">
					<tbody>
						<tr>
							<th>父分类</th>
							<td>
							<select name="pid" id="cid">
								<option value="0" 
								<?php if(($info['pid']) == "0"): ?>selected="selected"<?php endif; ?>
								>顶级分类</option>
								<?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" 
									<?php if(($info['pid']) == $vo['id']): ?>selected="selected"<?php endif; ?>
									>&nbsp;<?php echo ($vo["fullname"]); ?></option><?php endforeach; endif; ?>	
							</select>
							</td>
						</tr>
						<tr>
							<th>是否显示</th>
							<td>
								<label><input type="radio" name="status" value="1" <?php if(($info['status']) == "1"): ?>checked="checked"<?php endif; ?>  />显示</label>
								<label><input type="radio" name="status" value="0" <?php if(($info['status']) == "0"): ?>checked="checked"<?php endif; ?> />隐藏</label>
							</td>
						</tr>
						<tr>
							<th>分类名称</th>
							<td>
								<input type="text" name="title" value="<?php echo ($info["title"]); ?>" />

							</td>
						</tr>
						<tr>
							<th>分类排序</th>
							<td>
								<input type="text" name="sort"  value="<?php echo ($info["sort"]); ?>" />
							</td>
						</tr>
						<tr id="menu" <?php if(($info['pid']) != "0"): ?>style="display:none;"<?php endif; ?> >
							<th>是否显示在首页菜单</th>
							<td>
								<label><input type="checkbox" name="show_menu" id="show_menu" value="1" <?php if(($info['show_menu']) == "1"): ?>checked="checked"<?php endif; ?> />作为首页菜单项</label>
							</td>
						</tr>												
						<tr>
							<td colspan="2" class="ta-center">
								<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" /><input type="submit" value="保存添加" />
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