<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>真人图书馆-图书展示</title>
	<link rel="stylesheet" type="text/css" href="/library/Public/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/library/Public/css/front.css" />

	
	<link rel="stylesheet" type="text/css" href="/library/Public/css/kandytabs.css" />	
	<link rel="stylesheet" type="text/css" href="/library/Public/css/jquery.galleryview-3.0-dev.css" />
	<style>
		.gv_frame .gv_caption {
			color:#666;
		}
	</style>

	<script type="text/javascript" src="/library/Public/js/jquery-1.11.0.min.js"></script>

	
	<script type="text/javascript" src="/library/Public/js/kandytabs.pack.js"></script>
	<script type="text/javascript" src="/library/Public/js/jquery.timers-1.2.js"></script>
	<script type="text/javascript" src="/library/Public/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="/library/Public/js/jquery.galleryview-3.0-dev.js"></script>
	<script type="text/javascript" src="/library/Public/js/My97DatePicker/WdatePicker.js"></script>
	<script>
	var tab='<?php echo ($_GET['tab']); ?>';
	$(function(){

		//$('#simple').KandyTabs({trigger:'click'});
		if (tab=='') {tab=1};
		$('#simple').KandyTabs({trigger:'click',current:tab});
		$('#myGallery').galleryView({
		transition_speed: 1000, 		//INT - duration of panel/frame transition (in milliseconds)
		transition_interval: 4000, 		//INT - delay between panel/frame transitions (in milliseconds)
		easing: 'swing', 				//STRING - easing method to use for animations (jQuery provides 'swing' or 'linear', more available with jQuery UI or Easing plugin)
		show_panels: true, 	//BOOLEAN - flag to show or hide panel portion of gallery panels(主图)
		show_panel_nav: true, 			//BOOLEAN - flag to show or hide panel navigation buttons  panel_nav(主图导航)
		enable_overlays: true, 			//BOOLEAN - flag to show or hide panel overlays （i图标，用于显示图片title）
		
		panel_width: 700, 				//INT - width of gallery panel (in pixels)
		panel_height: 500, 				//INT - height of gallery panel (in pixels)
		panel_animation: 'fade', 		//STRING - animation method for panel transitions (crossfade,fade,slide,none)
		panel_scale: 'fit', 			//STRING - cropping option for panel images (crop = scale image and fit to aspect ratio determined by panel_width and panel_height, fit = scale image and preserve original aspect ratio)图片保持原来大小
		overlay_position: 'top', 	//STRING - position of panel overlay (bottom, top)
		pan_images: true,				//BOOLEAN - flag to allow user to grab/drag oversized images within gallery
		pan_style: 'drag',				//STRING - panning method (drag = user clicks and drags image to pan, track = image automatically pans based on mouse position
		pan_smoothness: 15,				//INT - determines smoothness of tracking pan animation (higher number = smoother)
		start_frame: 1, 				//INT - index of panel/frame to show first when gallery loads
		show_filmstrip: true, 			//BOOLEAN - flag to show or hide filmstrip portion of gallery (filmstrip图片导航)
		show_filmstrip_nav: true, 		//BOOLEAN - flag indicating whether to display navigation buttons
		enable_slideshow: true,			//BOOLEAN - flag indicating whether to display slideshow play/pause button （slideshow播放按钮）
		autoplay: false,				//BOOLEAN - flag to start slideshow on gallery load
		show_captions: true, 			//BOOLEAN - flag to show or hide frame captions	
		filmstrip_size: 3, 				//INT - number of frames to show in filmstrip-only gallery
		filmstrip_style: 'scroll', 		//STRING - type of filmstrip to use (scroll = display one line of frames, scroll filmstrip if necessary, showall = display multiple rows of frames if necessary)
		filmstrip_position: 'top', 	//STRING - position of filmstrip within gallery (bottom, top, left, right) 图片导航位置
		frame_width: 128, 				//INT - width of filmstrip frames (in pixels)
		frame_height: 90, 				//INT - width of filmstrip frames (in pixels)
		frame_opacity: 0.5, 			//FLOAT - transparency of non-active frames (1.0 = opaque, 0.0 = transparent)
		frame_scale: 'fit', 			//STRING - cropping option for filmstrip images (same as above)
		frame_gap: 3, 					//INT - spacing between frames within filmstrip (in pixels)
		show_infobar: true,				//BOOLEAN - flag to show or hide infobar
		infobar_opacity: 1				//FLOAT - transparency for info bar
		});
	});
	</script>


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
					
	<dl id="simple">
		<dt>基本信息</dt>
		<dd class="base">
			<div style="margin:10px 20px;height:170px;">
				<div class="photo">
					<img src="<?php echo ($book["photo"]); ?>" alt="<?php echo ($book["bookname"]); ?>"></div>
				<p class="summary"><?php echo ($book["summary"]); ?></p>

			</div>
			<div class="booklist">
				<table>
					<tr>
						<th>姓名</th>
						<td><?php echo ($book["bookname"]); ?></td>
						<th>&nbsp;</th>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<th>性别</th>
						<td>
							<?php if(($book["sex"]) == "1"): ?>男
								<?php else: ?>
								女<?php endif; ?>
						</td>
						<th>&nbsp;</th>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<th>出生日期</th>
						<td><?php echo (date('Y年m月d日',$book["birthday"])); ?></td>
						<th>&nbsp;</th>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<th>毕业学校</th>
						<td><?php echo ($book["university"]); ?></td>
						<th>学历</th>
						<td><?php echo ($book["edu_name"]); ?></td>
					</tr>
					<tr>
						<th>所属分类</th>
						<td><?php echo ($book["category"]); ?></td>
						<th>&nbsp;</th>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<th>标签</th>
						<td>
							<?php if(is_array($book["tag"])): $i = 0; $__LIST__ = $book["tag"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["tag_name"]); ?>&nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
						</td>
						<th>&nbsp;</th>
						<td>&nbsp;</td>
					</tr>
				</table>
				<h2>简介及联系信息</h2>
				<table>
					<tr>
						<th>联系电话</th>
						<td><?php echo ($book["phone1"]); ?>保密</td>
						<th>手机号码</th>
						<td><?php echo ($book["mobile1"]); ?>保密</td>
					</tr>
					<tr>
						<th>电子邮件</th>
						<td><?php echo ($book["email"]); ?></td>
						<th>QQ号码</th>
						<td><?php echo ($book["qq1"]); ?>保密</td>
					</tr>
					<tr>
						<th>个人主页</th>
						<td><?php echo ($book["homepage"]); ?></td>
						<th>邮政编码</th>
						<td><?php echo ($book["zip1"]); ?>保密</td>
					</tr>
					<tr>
						<th>联系地址</th>
						<td colspan="3"><?php echo ($book["address1"]); ?>保密</td>
					</tr>
					<tr>
						<th>我的简介</th>
						<td colspan="3"><?php echo ($book["resume"]); ?></td>
					</tr>
				</table>
			</div>
		</dd>
		<dt>详细介绍</dt>
		<dd>
			<div class="detail">
				<?php echo ($book["intro"]); ?>
			</div>
		</dd>
		<dt>图片展示</dt>
		<dd>
			<ul id="myGallery">
			<?php if(is_array($pic)): $i = 0; $__LIST__ = $pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            				<img data-frame="<?php echo ($vo["url"]); ?>" src="<?php echo ($vo["url"]); ?>" title="<?php echo ($vo["title"]); ?>" data-description="<?php echo ($vo["description"]); ?>" />
            			</li><?php endforeach; endif; else: echo "" ;endif; ?>
            		</ul>
		</dd>
		<dt>我要借阅</dt>
		<dd>
			<div class="yuding">
				<h3>你选择的真人书</h3>
				<div>
					<div class="photo fg">
						<img src="<?php echo ($book["photo"]); ?>" data-origin="#" alt="">
					</div>
					<div class="lecture-list">
						<p><span class="bookname"><?php echo ($book["bookname"]); ?></span> &nbsp;&nbsp;<?php if(($book["sex"]) == "1"): ?>男<?php else: ?>女<?php endif; ?>，生于<?php echo (date("Y",$book["birthday"])); ?>年，<?php echo ($book["edu_name"]); ?></p>
						<table >
							<tr>
								<th>讲座时间</th>
								<th>讲座地址</th>
								<th>参加人数</th>
							</tr>
							<?php if(is_array($lecture)): $k = 0; $__LIST__ = $lecture;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
								<td><?php echo (date("Y年m月d  H:i",$vo["time"])); ?></td>
								<td><?php echo ($vo["address"]); ?></td>
								<td><?php echo ($vo["num"]); ?></td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php $__FOR_START_14551__=$k;$__FOR_END_14551__=3;for($i=$__FOR_START_14551__;$i < $__FOR_END_14551__;$i+=1){ ?><tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr><?php } ?>
		

						</table>
					</div>
					<br class="clearfloat" />
				</div>
			</div>
			<div class="reserve">
				<h3>我的联系信息</h3>
				<p>如果你有意倾听他（她）的故事，请留下你的联系信息，以便我们联系你。</p>
				<form action="<?php echo U('Home/Index/add_reserve');?>" method="post" id="AddReserve">
					
				<table>
					<tr>
						<th>真实姓名</th>
						<td><input type="text" name="realname" style="width:100px;" />&nbsp;<label><input type="radio" name="sex" value="1" checked="checked" />男</label>&nbsp;<label><input type="radio" name="sex" value="0" />女</label></td>
						<th>手机号码</th>
						<td><input type="text" name="mobile"  style="width: 100%" />
						<input type="hidden" name="lid" value="<?php echo ($lecture_id); ?>" />
						<input type="hidden" name="bid" value="<?php echo ($book["id"]); ?>" />
						</td>
					</tr>
					<tr>
						<th>邮箱地址</th>
						<td><input type="text" name="email"  style="width: 100%"  /></td>
						<th>QQ号码</th>
						<td><input type="text" name="qq" style="width: 100%" /></td>
					</tr>
					<tr>
						<th>联系地址</th>
						<td colspan="3"><input type="text" name="address" style="width: 100%;" /></td>
					</tr>					
					<tr>
						<th>我的职业</th>
						<td><input type="text" name="vocation"  style="width: 100%" /></td>
						<th>出生年月</th>
						<td>
						 <input class="Wdate " readonly="true" type="text" name="birthday" onclick="WdatePicker()" style="width: 100%"  />
						</td>
					</tr>
					<tr>
						<th style="vertical-align: middle;">介绍</th>
						<td colspan="3">
							<textarea name="intro" cols="30" rows="3" style="width: 100%"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="4" style="text-align: right; ">
							<input type="submit" value="我要借阅" class="reserve-btn" />
						</td>
					</tr>
				</table>	
					
				</form>


			</div>
		</dd>
		<dt>留言板</dt>
		<dd>
			<div class="msg">
				<h3>留言板</h3>
				<ul>
				<?php if(is_array($message)): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
						<div class="msg-header">
							<span class="msg-name">书友</span>
							<span class="msg-time"><?php echo (date("Y年m月d日 H:i",$vo["time"])); ?>&nbsp;留言</span>
						</div>
						<div class="msg-content">
							<p>
								<?php echo ($vo["content"]); ?>
							</p>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<div class="writemsg">
				<h3>我要留言</h3>
				<form action="<?php echo U('Home/Index/add_message');?>" method="post">
				<p>
				<textarea name="content" id=""  cols="60" rows="5"></textarea>
				<input type="hidden" name="bid" value="<?php echo ($book["id"]); ?>" />
				</p>
				<p style="padding:0px 5px 10px;text-align: right;">
					<input type="submit" value="提交" class="reserve-btn" />
				</p>
				</form>
			</div>
		</dd>
	</dl>
	
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