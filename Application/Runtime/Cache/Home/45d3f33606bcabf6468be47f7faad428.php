<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>罗湖区图书馆之真人图书馆</title>
	<link rel="stylesheet" href="/library/Public/css/reset.css" />
	<link rel="stylesheet" href="/library/Public/css/front.css" />
</head>
<body>
	<div id="header">
		<h1><a href="#">罗湖区图书馆-真人图书馆</a></h1>
		<div class="search">
			<form method="get" action="<?php echo U('Home/Index/search');?>">
				<span class="inp"><input type="text" autocomplete="off" name="q" placeholder="姓名、标记" size="12" maxlength="60"></span>
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
		<div class="wrapper">
			<div class="sidenav">
				<div class="category">
						<h2>所有分类</h2>

						<ul>
							<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/getBookByCategory',array('cid'=>$vo['id']));?>"><?php echo ($vo["cate_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
				</div>
			</div>
			<div class="side">
				<h2>最受关注真人图书馆 <!--<span class="pl">&nbsp;( <a target="_self" href="#">更多</a>)</span>-->
                			</h2>
				<ol>
					<?php if(is_array($tag)): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/getBookByTag',array('tid'=>$vo['id']));?>"><?php echo ($vo["tag_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ol>
			</div>
			<div class="main">
				<div class="mod">
					<div class="albums">
						<h2>新书上架……<span class="pl">&nbsp;( <a target="_self" href="<?php echo U('Home/Index/more');?>">更多</a>)</span>
                					</h2>
                					<ul>
                                                                            <?php if(is_array($book)): foreach($book as $key=>$vo): ?><li>
                                                                              <div class="photo">
                                                                                  <a href="<?php echo U('Home/Index/bookShow',array('id'=>$vo['id']));?>"><img alt="" data-origin="#" src="<?php echo ($vo["photo"]); ?>" /></a>
                                                                              </div>
                                                                              <div class="title">
                                                                                <a href="<?php echo U('Home/Index/bookShow',array('id'=>$vo['id']));?>"><?php echo ($vo["summary"]); ?></a>
                                                                              </div>
                                                                              
                                                                             </li><?php endforeach; endif; ?>

						</ul>
					</div>


					<div class="albums">
						<h2>热门真人书<span class="pl">&nbsp;( <a target="_self" href="<?php echo U('Home/Index/more');?>">更多</a>)</span>
                					</h2>
                					<ul>
                                                                            <?php if(is_array($hotbook)): foreach($hotbook as $key=>$vo): ?><li>
                                                                              <div class="photo">
                                                                                  <a href="<?php echo U('Home/Index/bookShow',array('id'=>$vo['id']));?>"><img alt="" data-origin="#" src="<?php echo ($vo["photo"]); ?>" /></a>
                                                                              </div>
                                                                              <div class="title">
                                                                                <a href="<?php echo U('Home/Index/bookShow',array('id'=>$vo['id']));?>"><?php echo ($vo["summary"]); ?></a>
                                                                              </div>
                                                                              
                                                                             </li><?php endforeach; endif; ?>

						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>


	<div class="wrapper">
	  <div id="ft">
	<span class="fleft gray-link" id="icp">
	    &copy; 2014－2015 逐日软件, all rights reserved
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