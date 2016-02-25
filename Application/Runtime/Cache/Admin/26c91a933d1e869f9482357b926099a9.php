<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>添加文章</title>
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

 		var validator = $("#frmAddUser").validate({
			rules: {
				username: "required",
				// category:{required: true,min:1},
			},
			messages: {
				username: "请输入用户名",
				// category: "必须选择文章栏目" ,
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

/* 		$('ul.role input:checkbox').click(function(event){
			// event.stopPropagation();
			// event.preventDefault();
			// alert($(this).val());
			alert("abc");
 			$(this).parent().parent().find(':checkbox').attr("checked",this.checked);

 		})*/

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
		<h3>添加用户</h3>
		<div class="division">
			<form action="<?php echo U('Admin/User/addHandle');?>" method="post" id="frmAddUser">
				<table class="liststyle data" width="100%">
					<tbody>
						<tr>
							<th>登录名</th>
							<td>
								<input type="text" name="username" id="username" class="half" />
								<label for="username" class="required"></label>
							</td>
						</tr>
						<tr>
							<th>昵称</th>
							<td>
								<input type="text" name="nickname" id="nickname" class="half" />
							</td>
						</tr>
						<tr>
							<th>密码</th>
							<td>
								<input type="password" name="password" class="half" />
							</td>
						</tr>										
						<tr>
							<th>状态</th>
							<td>
								<select name="status" id="status" >
									<option value="1" selected="selected">正常</option>
									<option value="0">锁定</option>
									
								</select>
	
							</td>
						</tr>
						<tr>
							<th>管理模块</th>
							<td>
								<ul class="role">
									<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
									<label><input type="checkbox" name="role[]" id="" value="<?php echo ($vo["id"]); ?>" /><?php echo ($vo["title"]); ?></label>
									<?php if(!empty($vo['child'])): ?><ul><?php endif; ?>
									<?php if(is_array($vo['child'])): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><label><input type="checkbox" name="role[]" id="" value="<?php echo ($v["id"]); ?>" /><?php echo ($v["title"]); ?></label>
										<?php if(!empty($v['child'])): ?><ul><?php endif; ?>
											<?php if(is_array($v['child'])): $i = 0; $__LIST__ = $v['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><li><label><input type="checkbox" name="role[]" id="" value="<?php echo ($v1["id"]); ?>" /><?php echo ($v1["title"]); ?></label></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
<script>
	function bindNodes(selector,parentNode){
		var parent = $(selector).find(" > li");
		parent.each(function(index, element){
			var child = $(element).find("> ul > li"),child2 = null;
			if(child.length == 0){
				return;
			}
			child.each(function(index,e){
				$(this).data("parentNode",[element]);
				if($(this).find("> ul").length > 0){
					var _child = $(this);
					child2 = getChild(_child);
					child2.each(function(index,e){
						$(this).data("parentNode",[element,_child]);
					});
					$(_child).find(" > label").click(toggleChilds);
				}
			})
			$(element).find(" > label").click(toggleChilds);
			child.add(child2).find("> label > input[type=checkbox]").click(function(){
				var parentNode = $($(this).parent().parent()[0]).data("parentNode");
				if($(this).is(":checked")){
					$(parentNode).each(function(){
						$(this).find("> label input[type=checkbox]").attr("checked","checked");
					});
				}
			});
		});
	}
	function getChild(selector){
		var child = $(selector).find("> ul > li");
		if(child.find("> ul").length > 0){
			return [child].concat(getChild(child));
		}else{
			return child;
		}
	}
	function toggleChilds(){
		var isCheck = $(this).find("input[type=checkbox]").is(":checked")
		if(isCheck){
			$(this).parent().find("> ul input[type=checkbox]").attr("checked","checked");
		}else{
			$(this).parent().find("> ul input[type=checkbox]").removeAttr("checked");
		}
	}
	bindNodes($(".role"));	
</script>

			</section>
		</section>


	</div>

	<!-- Scroll to top link -->
	<a href="#" id="totop"> </a>
</body>

</html>