<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>活动报名</title>
	<link rel="stylesheet" type="text/css" href="/gold/Public/jqmobile/jquery.mobile-1.4.5.min.css" />
</head>
<body>
	<div data-role="page" id="pageone">
		<!-- <div data-role="header"  data-position="fixed">
			<h1>活动报名</h1>
		</div> -->

		<div data-role="content">
			<form action="<?php echo U('Home/Index/upload_pic');?>" method="post" enctype="multipart/form-data" name="frm" data-ajax="false">
			 <div data-role="fieldcontain">
				<label for="upfile">全家福照片（300*223）</label>
				<input type="file" name="upfile" id="upfile" placeholder="一张有创意的全家福照片" />
				<label for="title">梦想名称</label><input type="text" name="title" id="title" placeholder="家庭梦想名称"  required="required" />
				<label for="declaration">梦想宣言（30字以内）</label><textarea name="declaration" id="declaration" placeholder="一个关于助益家乡梦想宣言"  required="required" ></textarea>
				
				<label for="uname">姓名</label><input type="text" name="uname" id="uname" placeholder="家庭团队代表姓名"  />
				<!-- <label for="edu">学历</label><input type="text" name="edu" id="edu" placeholder="学历" /> -->
			</div>	
			<fieldset data-role="fieldcontain">
			    <label for="edu">学历</label>
			    <select name="edu" id="edu">
			      <option value="博士">博士研究生</option>
			      <option value="硕士">硕士研究生</option>
			      <option value="本科" selected>本科</option>
			      <option value="专科">专科</option>
			      <option value="高中">高中</option>
			      <option value="初中">初中</option>
			      <option value="小学">小学</option>
			      <option value="幼儿园">幼儿园</option>
			    </select>
			  </fieldset>
			
			<div data-role="fieldcontain">
				<label for="contact">联系方式</label><input type="text" name="contact" id="contact" placeholder="联系方式"  />
				<label for="community">所在社区</label><input type="text" name="community" id="community" placeholder="家庭所在社区"   />
				
				<!-- <input type="button" value="测试" data-inline="true" /> -->
			</div>
			<p><input type="submit" value="报名" data-ajax="false"  data-theme="d" /></p>
			</form>
		</div>

		<!-- <div data-role="footer"  data-position="fixed">
			<h1>江西小主人</h1>
		</div> -->
	</div> 
	<script type="text/javascript" src="/gold/Public/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="/gold/Public/jqmobile/jquery.mobile-1.4.5.min.js"></script>

</body>
</html>