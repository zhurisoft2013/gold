<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>上传设置</title>
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
					<a href="#">主页</a>
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
					<dt>分类管理</dt>
					<dd><a href="<?php echo U('Admin/Category/index');?>"><em class="menu-icon icon-list"></em>分类列表</a></dd>
					<dd><a href="<?php echo U('Admin/Category/add');?>"><em class="menu-icon icon-plus"></em>添加分类</a></dd>
					<dt>附件管理</dt>
					<dd><a href="<?php echo U('Admin/Attachment/index');?>"><em class="menu-icon icon-list"></em>附件列表</a></dd>						
					<dt>系统设置</dt>
					<dd><a href="<?php echo U('Admin/System/uploadSet');?>"><em class="menu-icon icon-list"></em>上传设置</a></dd>

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
		<h3>上传设置</h3>
		<div class="division">
		<form action="<?php echo U('Admin/System/saveUploadSet');?>" method="post">
			<table class="liststyle data" width="100%">
				<tbody>
					<tr>
						<th>上传根路径(RootPath)</th>
						<td>
							<input type="text" name="UPLOAD_ROOT_PATH" class="half" value="<?php echo (C("UPLOAD_ROOT_PATH")); ?>" />
						</td>
					</tr>
					<tr>
						<th>上传子路径(SavePath)</th>
						<td>
							<input type="text" name="UPLOAD_SAVE_PATH" class="half" value="<?php echo (C("UPLOAD_SAVE_PATH")); ?>" />
						</td>
					</tr>
					<tr>
						<th>缩略图方式</th>
						<td>
							<label for="NOTHUMB">
								<input type="radio" name="THUMB" id="NOTHUMB" value="0" <?php if((C("THUMB")) == "0"): ?>checked="checked"<?php endif; ?> />
								无缩略图
							</label>
							<label for="SCALE">
								<input type="radio" name="THUMB" id="SCALE" value="1"  <?php if((C("THUMB")) == "1"): ?>checked="checked"<?php endif; ?> />
								等比例缩放
							</label>
							<label for="FILLED">
								<input type="radio" name="THUMB" id="FILLED" value="2" <?php if((C("THUMB")) == "2"): ?>checked="checked"<?php endif; ?> />
								缩放后填充
							</label>
							<label for="CENTER">
								<input type="radio" name="THUMB" id="CENTER" value="3" <?php if((C("THUMB")) == "3"): ?>checked="checked"<?php endif; ?> />
								居中裁剪
							</label>
							<label for="NORTHWEST">
								<input type="radio" name="THUMB" id="NORTHWEST" value="4" <?php if((C("THUMB")) == "4"): ?>checked="checked"<?php endif; ?> />
								左上角裁剪
							</label>
							<label for="SOUTHEAST">
								<input type="radio" name="THUMB" id="SOUTHEAST" value="5" <?php if((C("THUMB")) == "5"): ?>checked="checked"<?php endif; ?> />
								右上角裁剪
							</label>
							<label for="FIXED">
								<input type="radio" name="THUMB" id="FIXED" value="6" <?php if((C("THUMB")) == "6"): ?>checked="checked"<?php endif; ?> />
								固定尺寸缩放
							</label>

						</td>
					</tr>
					<tr>
						<th>水印</th>
						<td>
							<label for="WATER">
								<input type="radio" name="WATER" id="WATER" value="0" <?php if((C("WATER")) == "0"): ?>checked="checked"<?php endif; ?> />无水印 <br />
							</label>
							<label for="waterText">
								<input type="radio" name="WATER" id="waterText" value="1"  <?php if((C("WATER")) == "1"): ?>checked="checked"<?php endif; ?>  />水印文字
							</label><input type="text" name="WATER_TEXT" value="<?php echo (C("WATER_TEXT")); ?>" /><br />
							<label for="waterPic">
								<input type="radio" name="WATER" id="waterPic"  value="2" <?php if((C("WATER")) == "2"): ?>checked="checked"<?php endif; ?> />水印图片
							</label><input type="text" name="WATER_IMAGE" value="<?php echo (C("WATER_IMAGE")); ?>" /> <br />
						</td>
					</tr>
					<tr>	
						<th>水印位置</th>
						<td>
							<label for="POSITION_NORTHWEST">
								<input type="radio" name="WATER_POSITION" id="POSITION_NORTHWEST" value="1" <?php if((C("WATER_POSITION")) == "1"): ?>checked="checked"<?php endif; ?> />左上角
							</label>			
							<label for="POSITION_NORTH">
								<input type="radio" name="WATER_POSITION" id="POSITION_NORTH" value="2" <?php if((C("WATER_POSITION")) == "2"): ?>checked="checked"<?php endif; ?> />上居中
							</label>
							<label for="POSITION_NORTHEAST">
								<input type="radio" name="WATER_POSITION" id="POSITION_NORTHEAST" value="3" <?php if((C("WATER_POSITION")) == "3"): ?>checked="checked"<?php endif; ?> />右上角
							</label>			
							<label for="POSITION_WEST">
								<input type="radio" name="WATER_POSITION" id="POSITION_WEST" value="4" <?php if((C("WATER_POSITION")) == "4"): ?>checked="checked"<?php endif; ?> />左居中
							</label> 
							<label for="POSITION_CENTER">
								<input type="radio" name="WATER_POSITION" id="POSITION_CENTER" value="5" <?php if((C("WATER_POSITION")) == "5"): ?>checked="checked"<?php endif; ?> />居中
							</label>			
							<label for="POSITION_EAST">
								<input type="radio" name="WATER_POSITION" id="POSITION_EAST" value="6" <?php if((C("WATER_POSITION")) == "6"): ?>checked="checked"<?php endif; ?> />右居中
							</label>			
							<label for="POSITION_SOUTHWEST">
								<input type="radio" name="WATER_POSITION" id="POSITION_SOUTHWEST" value="7" <?php if((C("WATER_POSITION")) == "7"): ?>checked="checked"<?php endif; ?> />左居中
							</label>
							<label for="POSITION_SOUTH">
								<input type="radio" name="WATER_POSITION" id="POSITION_SOUTH" value="8" />下居中
							</label>
							<label for="POSITION_SOUTHEAST">
								<input type="radio" name="WATER_POSITION" id="POSITION_SOUTHEAST" value="9"  <?php if((C("WATER_POSITION")) == "9"): ?>checked="checked"<?php endif; ?>  />右下脚
							</label> 
						</td>
					</tr>
					<tr>
						<td colspan="2" class="ta-center">
							<input type="submit" value="保存设置" class="btn btn-black" />
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