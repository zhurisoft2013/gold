<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html><head>
        <meta charset="utf-8">
        <title>Page Not Found :(</title>
        <style>
            *{
                margin: 0;padding: 0;
            }
            ::-moz-selection {
                background: #b3d4fc;
                text-shadow: none;
            }

            ::selection {
                background: #b3d4fc;
                text-shadow: none;
            }

            html {
                padding: 30px 10px;
                font-size: 20px;
                line-height: 1.4;
                color: #737373;
                background: #f0f0f0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }

            html,
            input {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            }

            body {
                max-width: 600px;
                _width: 600px;
                padding: 30px 20px 50px;
                border: 1px solid #b3b3b3;
                border-radius: 4px;
                margin: 0 auto;
                box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff;
                background: #fcfcfc;
                font-family: '微软雅黑'; color: #333; 
                font-size: 16px;
            }


            h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }

            h3 {
                margin: 1.5em 0 0.5em;
            }



            ul {
                padding: 0 0 0 40px;
                margin: 1em 0;
            }

            .container {
                max-width: 380px;
                _width: 380px;
                margin: 0 auto;
            }


            input::-moz-focus-inner {
                padding: 0;
                border: 0;
            }
            .jump{ padding-top: 10px}
            .jump a{ color: #333;}
            .success, .error{ line-height: 1.8em; font-size: 36px }
            .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
        </style>
    </head>
    <body>
        <div class="container">
            <?php if(isset($message)): ?><h1>:)</h1>
            <p class="success"><?php echo($message); ?></p>
            <?php else: ?>
            <h1>:(</h1>
            <p class="error"><?php echo($error); ?></p><?php endif; ?>
            <p class="detail"></p>
            <p class="jump">
            页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
            </p>
        </div>
 <script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
    var time = --wait.innerHTML;
    if(time <= 0) {
        location.href = href;
        clearInterval(interval);
    };
}, 1000);
})();
</script>   

    </body>
</html>