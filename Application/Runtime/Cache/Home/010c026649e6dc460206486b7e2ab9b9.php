<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>搜索结果</title>
    <link rel="stylesheet" href="/gold/Public/css/reset.css" />
    <link rel="stylesheet" href="/gold/Public/css/front.css" />
    
<style>

</style>

    <style>

    </style>
    
</head>
<body>
    <div class="container">
        <div class="top">
            <form action="<?php echo U('Home/Index/search');?>" method="post" id="frmLogin">
                <p><input type="text" name="username" placeholder="ID" size="12" maxlength="60" class="txt" />
                <input type="password" name="password" placeholder="PASSWORD" size="12" maxlength="60" class="txt"  />
                <input type="submit" value="GO" class="btn">
                </p>
            </form>
        </div>
        <div class="header">
            <h1><a href="/gold">罗图-黄金珠宝数据库</a></h1>
            <ul>
                <?php if(is_array($navlist)): $i = 0; $__LIST__ = $navlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Home/Index/articleList',array('cid'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>
        </div>
        <div class="sidebar1">
            <form action="<?php echo U('Home/Index/search');?>" method="post" id="frmSearch">
                <h3>关键字查询</h3>
                <p><input type="text" name="q" placeholder="输入关键字" size="12" maxlength="60" class="txt" /></p>
                <p style=""><input type="submit" value="开始查询" class="btn" /></p>
            </form>
        </div>
        
    <div class="result">
     <h3>搜索结果</h3>
    <ul>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <div class="result-header">
                        <a href="<?php echo U('Home/Index/article',array('id'=>$vo['id']));?>"><span class="bookname"><?php echo ($vo["title"]); ?></span>&nbsp;&nbsp;/<?php echo (date("Y-m-d",$vo["createtime"])); ?> /  <?php echo ($vo["category"]); ?></a>
                    </div>
                    <div class="result-content">
                    <p><?php echo ($vo["content"]); ?>...</p>
                    </div>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>       
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