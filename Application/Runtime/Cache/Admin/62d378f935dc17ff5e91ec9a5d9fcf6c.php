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
	
    <script type="text/javascript" src="/gold/Public/ueditor/ueditor.config.js"></script>    
    <script type="text/javascript" src="/gold/Public/ueditor/ueditor.all.min.js"></script>

	<script>

	$(function(){

		       var url='<?php echo U('Admin/Ueditor/Index');?>';
		       var ue = UE.getEditor('editor',{
		            serverUrl :url,
		            UEDITOR_HOME_URL:'/gold/Public/ueditor/',
		            initialFrameWidth : 800,
		            toolbars: [
				    [
				        // 'anchor', //锚点
				       'source', //源代码
				       'undo', //撤销
				       'redo', //重做
				       '|',
				       'paragraph', //段落格式
				        'fontfamily', //字体
				        'fontsize', //字号
				       'bold', //加粗				        
				        // 'snapscreen', //截图
				        'italic', //斜体
				        'underline', //下划线
				        // 'strikethrough', //删除线

				        'subscript', //下标
				        // 'fontborder', //字符边框
				        'superscript', //上标
				        'formatmatch', //格式刷
				        'forecolor', //字体颜色
				        'backcolor', //背景色
				        '|',
				       'pasteplain', //纯文本粘贴模式
				       '|',
				        'justifyleft', //居左对齐
				        'justifyright', //居右对齐
				        'justifycenter', //居中对齐
				        'justifyjustify', //两端对齐
				        '|',
				        'insertorderedlist', //有序列表
				        'insertunorderedlist', //无序列表
				        '|',
				        'selectall', //全选
				        'removeformat', //清除格式
				        'cleardoc', //清空文档
				        '|',

				        'fullscreen', //全屏

				       'inserttable', //插入表格
				        'mergecells', //合并多个单元格
  				       'simpleupload', //单图上传
				        'insertimage', //多图上传
				         'attachment', //附件
				        // 'blockquote', //引用	       
				        'insertvideo', //视频
				         'music', //音乐
				         'emotion', //表情
				        'horizontal', //分隔线
				        
				        // 'time', //时间
				        'date', //日期
				         'link', //超链接
				        'unlink', //取消链接
				        '|',
				        // 'insertrow', //前插入行
				        // 'insertcol', //前插入列
				        // 'mergeright', //右合并单元格
				        // 'mergedown', //下合并单元格
				        // 'deleterow', //删除行
				        // 'deletecol', //删除列
				        // 'splittorows', //拆分成行
				        // 'splittocols', //拆分成列
				        // 'splittocells', //完全拆分单元格
				        // 'deletecaption', //删除表格标题
				        // 'inserttitle', //插入标题
				       
				        // 'deletetable', //删除表格

				        // 'insertparagraphbeforetable', //"表格前插入行" 
				      
				        // 'edittable', //表格属性
				        // 'edittd', //单元格属性 
				       
				        // 'spechars', //特殊字符
				        'searchreplace', //查询替换
				        // 'map', //Baidu地图
				        // 'gmap', //Google地图
				       
				        // 'help', //帮助
				       
				        // 'directionalityltr', //从左向右输入
				        // 'directionalityrtl', //从右向左输入
				        '|',
				        'indent', //首行缩进 
				        'rowspacingtop', //段前距
				        'rowspacingbottom', //段后距
				        // 'pagebreak', //分页
				        // 'insertframe', //插入Iframe
				        // 'imagenone', //默认
				        // 'imageleft', //左浮动
				        // 'imageright', //右浮动
				       
				        // 'imagecenter', //居中
				        // 'wordimage', //图片转存
				        'lineheight', //行间距
				        // 'edittip ', //编辑提示
				        // 'customstyle', //自定义标题
				        'autotypeset', //自动排版
				        '|',
				        // 'webapp', //百度应用
				        // 'touppercase', //字母大写
				        // 'tolowercase', //字母小写
				        'background', //背景
				        
				        // 'scrawl', //涂鸦 
				        // 'drafts', // 从草稿箱加载
				        // 'charts', // 图表
				        // 'insertcode', //代码语言
				        '|',
				       'preview', //预览
				       'print', //打印
				       'template', //模板

				    ]
				]
		        });

		        ue.ready(function(){
		            ue.execCommand('serverparam', {
		               'userid' : '<?php echo (session('userid')); ?>',
		               'username': '<?php echo (session('username')); ?>', 
		               'module':'<?php echo (MODULE_NAME); ?>',
		               'controller':'<?php echo (CONTROLLER_NAME); ?>',
		               'actionname':'<?php echo (ACTION_NAME); ?>',
		            });
		        });

 		var validator = $("#frmAddArticle").validate({
			rules: {
				title: "required",
				category:{required: true,min:1},
			},
			messages: {
				title: "请输入标题",
				category: "必须选择文章分类" ,
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
					<a href="/gold/index.php/Admin/Article">主页</a>
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
		<h3>添加文章</h3>
		<div class="division">
			<form action="<?php echo U('Admin/Article/addHandle');?>" method="post" id="frmAddArticle">
				<table class="liststyle data" width="100%">
					<tbody>
						<tr>
							<th>标题</th>
							<td>
								<input type="text" name="title" id="title" class="half" />
								<label for="title" class="required"></label>
							</td>
						</tr>
						<tr>
							<th>所属分类</th>
							<td>
								<select name="category_id" id="category" >
									<option value="" >==请选择分类==</option>
									<?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"
										<?php if(($_COOKIE['category_id']) == $vo['id']): ?>selected="selected"<?php endif; ?>
										><?php echo ($vo["fullname"]); ?></option><?php endforeach; endif; ?>

								</select>
								<label for="category" class="required"></label>
							</td>
						</tr>
						<tr>
							<th>是否置顶</th>
							<td>
								<label><input type="checkbox" name="top" />置顶</label>
							</td>
						</tr>
						<tr>
							<th>文章排序</th>
							<td>
								<input type="text" name="sort" value="100" />
							</td>
						</tr>
						<tr>
							<th>文章内容</th>
							<td>
								<script id="editor" type="text/plain" name="content" ></script>
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