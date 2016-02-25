<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>罗图-黄金珠宝数据库</title>
    <link rel="stylesheet" type="text/css" href="/gold/Public/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/gold/Public/css/front.css" />
    <script type="text/javascript" src="/gold/Public/js/jquery-1.11.0.min.js"></script>
    
    <style>

    </style>
    
</head>
<body>
    <div class="container">
        <!--<div class="top">
        
            <form action="<?php echo U('Home/Index/search');?>" method="post" id="frmLogin">
                <p><input type="text" name="username" placeholder="ID" size="12" maxlength="60" class="txt" />
                <input type="password" name="password" placeholder="PASSWORD" size="12" maxlength="60" class="txt"  />
                <input type="submit" value="GO" class="btn">
                </p>
            </form>
            
        </div>-->
        <div class="header">
            <h1><a href="/gold">罗图-黄金珠宝数据库</a></h1>
            <ul>
                <?php if(is_array($navlist)): $i = 0; $__LIST__ = $navlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/articleList',array('cid'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>
        </div>
        <div class="sep" style="height:20px;background:#fff;"></div>
        <div class="sidebar1">
            <?php if(!empty($title)): ?><div class="listnav">
                    <h3><?php echo ($title); ?>
                    <?php if(($sublist_pid) > "0"): ?><small><a href="<?php echo U('Home/Index/articleList',array('cid'=>$sublist_pid));?>">返回</a></small><?php endif; ?>
                    </h3>
                    <?php if(!empty($sublist)): ?><ul>
                        <?php if(is_array($sublist)): $i = 0; $__LIST__ = $sublist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/articleList',array('cid'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><?php endif; ?>                    
                </div><?php endif; ?>
            <form action="<?php echo U('Home/Index/search');?>" method="post" id="frmSearch">
                <h3>关键字查询</h3>
                <p><input type="text" name="q" placeholder="输入关键字" size="12" maxlength="60" class="txt" /></p>
                <p style=""><input type="submit" value="开始查询" class="btn" /></p>
            </form>
        </div>
        
    <div class="content">
        <div class="list">
            <h4>[ <?php echo ($category_name); ?> ] 文章列表</h4>
            <ul>
                <?php if(is_array($article_list)): $i = 0; $__LIST__ = $article_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/article',array('id'=>$vo['id']));?>" title="<?php echo ($vo["title"]); ?>" class="newslist" target="_blank"><?php if(($vo['top']) == "1"): ?>[推荐]<?php endif; echo ($vo["title"]); ?></a>&nbsp;&nbsp;<span class="Time"><?php echo (date("Y-m-d",$vo["create_time"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <div class="manu"><?php echo ($pageinfo); ?></div>
        </div>
    </div>

        <div class="footer clearfloat">
                <h2><a href="#">罗图-黄金珠宝数据库</a></h2>
                <ul>
                    <li><a href="#">知识产权声明</a></li>
                    <li><a href="#">服务承诺</a></li>
                    <li><a href="#">联系我们</a></li>
                    <li><a href="#">客户服务</a></li>
                    <li><a href="#">关于我们</a></li>
                </ul>
        </div>
    </div>

</body>
</html>