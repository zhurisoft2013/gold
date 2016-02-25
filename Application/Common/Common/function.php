<?php 
function p($arr){
    echo '<pre>' . print_r($arr,true) .'</pre>';
}
function systemLog($userid, $username, $event, $auditing, $reason='', $remark=''){
    $data=array(
      'userid' => $userid,
      'username' => $username,
      'log_time' => time(),
      'log_ip' => get_client_ip(),
      'module' => MODULE_NAME,
      'controller' =>CONTROLLER_NAME,
      'action' =>ACTION_NAME,
      'event' => $event,
      'auditing' => $auditing,
      'reason' => $reason,
      'remark' => $remark
      );
    M('Log')->add($data);
  }
function category_merge($cate ,$pid=0){
	$arr=array();
	foreach ($cate as $key => $value) {
		if($value['pid']==$pid){
			$value['child']=category_merge($cate, $value['id']);
			$arr[]=$value;
		}
	}
	return $arr;
}
function category_merge2($cate, $pid=0, $html='--' ,$level=0){
	$arr=array();
	foreach ($cate as $key => $value) {
		if ($value['pid']==$pid) {
			$value['level']=$level;
			$value['html']=str_repeat($html, $level);
			$arr[]=$value;
			$arr=array_merge($arr,category_merge2($cate,$value['id'],$html,$level+1));
		}
	}
	return $arr;
}

/**
 * 根据给出的id，得到父id
 * @param  [type] $cate [description]
 * @param  [type] $id   [description]
 * @return [type]       [description]
 */
function getParentId($cate, $id){
    // dump($cate[$id]['pid']);

    if($cate[$id]['pid']==0){
        return $id;
    }else{
        return getParentId($cate, $cate[$id]['pid']);
    }
}
/**
 * 得到给定id的，所有id
 * @param  [type]  $cate [description]
 * @param  integer $pid  [description]
 * @return [type]        [description]
 */
function getChildIds($cate,$pid=0){
      $arr=array();
      foreach ($cate as $value) {
        if ($value['pid']==$pid) {
          $arr[]=$value['id'];
          $arr=array_merge($arr,getChildIds($cate,$value['id']));
        }
      }
      return $arr;
}

function getUniqueFilename($savePath, $filename ,$has_ext=true){
            /* 
         * This number is used to generate partially randomized filenames to avoid 
         * collisions. 
         * It starts at 1. 
         * The next 9 iterations increment it by 1 at a time (up to 10). 
         * The next 9 iterations increment it by 1 to 10 (random) at a time. 
         * The next 9 iterations increment it by 1 to 100 (random) at a time. 
         * ... Up to the point where it increases by 100000000 at a time. 
         * (the maximum value that can be reached is 1000000000) 
         * As soon as a number is reached that generates a filename that doesn't exist, 
         *     that filename is used. 
         * If the filename coming in is [base].[ext], the generated filenames are 
         *     [base]-[sequence].[ext]. 
         */
        
        $fullFilename=$savePath . $filename;

        $i= strrpos($filename, '.');
        $ext= substr($filename,$i);
        $filename_noext=substr($filename,0,$i);

        $pattern="/[\x7f-\xff]/";
        if (preg_match($pattern, $filename)) {
            // echo "含有中文";
            // $filename_noext=uniqid();
            $filename_noext = date("YmdHis") . '_' . rand(10000, 99999);
            $filename=$filename_noext . $ext;
        }

        // $f=preg_replace('/^.+[\\\\\\/]/', '', $filename);


        // $filename_noext=basename($filename, $ext);
        // echo $filename_noext;
        if(!file_exists($fullFilename)){
            if ($has_ext) {
                // $filename= iconv("UTF-8","gb2312", $filename);
                 // echo 'FILE3:' .  $filename . 'end';
                return $filename;
            }else{
               // $filename_noext= iconv("UTF-8","gb2312", $filename_noext);
                return $filename_noext;
            }
        }

        $filename_noext .='-';
        $sequence=1;
        for ($i=1; $i < 1000000000; $i*=10) { 
            for ($j=0; $j < 9; $j++) { 
                $newFilename= $filename_noext . $sequence .  $ext;
                // echo $newFilename;
                $fullFilename=$savePath . $newFilename;
                if (!file_exists($fullFilename)) {
                        if ($has_ext) {
                           // $newFilename= iconv("UTF-8","gb2312", $newFilename);
                            return $newFilename;
                        }else{
                              $filename_noext=basename($newFilename, $ext);
                              // $filename_noext= iconv("UTF-8","gb2312", $filename_noext);
                              return $filename_noext;
                        }
                }
                $sequence+=rand(0,i)+1;
            }
        }
    }
function byte_format($input, $dec=0)
{
  $prefix_arr = array("B", "K", "M", "G", "T");
  $value = round($input, $dec);
  $i=0;
  while ($value>1024)
  {
     $value /= 1024;
     $i++;
  }
  $return_str = round($value, $dec).$prefix_arr[$i];
  return $return_str;
}

    /**
     * 计算给定时间戳与当前时间相差的时间，并以一种比较友好的方式输出
     * @param  [int] $timestamp [给定的时间戳]
     * @param  [int] $current_time [要与之相减的时间戳，默认为当前时间]
     * @return [string]            [相差天数]
     */
    function tmspan($timestamp,$current_time=0){
        if(!$current_time) $current_time=time();
        $span=$current_time-$timestamp;
        if($span<60){
            return "刚刚";
        }else if($span<3600){
            return intval($span/60)."分钟前";
        }else if($span<24*3600){
            return intval($span/3600)."小时前";
        }else if($span<(7*24*3600)){
            return intval($span/(24*3600))."天前";
        }else{
            return date('Y-m-d',$timestamp);
        }
    }

 function send_mail($title, $content){
        //echo $content;
        vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件
        $mail = new \PHPMailer(); //建立邮件发送类

        $address = "376417318@qq.com";//接收邮件地址
        $mail->IsSMTP(); // 使用SMTP方式发送
        $mail->Host = "smtp.qq.com"; // 您的企业邮局域名
        $mail->SMTPAuth = true; // 启用SMTP验证功能
        $mail->Username = "376417318@qq.com"; // 发送方邮件地址(请填写完整的email地址)
        $mail->Password = "yy20071025"; //发送放邮件密码
        $mail->Port=25;
        $mail->From = "376417318@qq.com"; //发送方邮件地址
        $mail->FromName = "myname";
        $mail->AddAddress("$address", "myname");//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")
        //$mail->AddReplyTo("", "");
 
        //$mail->AddAttachment("/var/tmp/file.tar.gz"); // 添加附件
        //$mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
        $mail->CharSet = "utf-8";
        $mail->Subject = "----$title----微信公号【都市微生活助手】"; //邮件标题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略
 
        if(!$mail->Send())
        {
            return $mail->ErrorInfo;
        }
        return "ok";
    }

    /**
     * 系统邮件发送函数
     * @param string $to    接收邮件者邮箱
     * @param string $name  接收邮件者名称
     * @param string $subject 邮件主题 
     * @param string $body    邮件内容
     * @param string $attachment 附件列表
     * @return boolean 
     */
    function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
        // $config = C('THINK_EMAIL');
        $config=array(
            'SMTP_HOST'   => 'smtp.qq.com', //SMTP服务器
            'SMTP_PORT'   => '465', //SMTP服务器端口
            'SMTP_USER'   => '376417318@qq.com', //SMTP服务器用户名
            'SMTP_PASS'   => 'yy20071025', //SMTP服务器密码
            'FROM_EMAIL'  => '376417318@qq.com', //发件人EMAIL
            'FROM_NAME'   => 'ThinkPHP', //发件人名称
            'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
            'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
        );
        vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件

        $mail             = new \PHPMailer(); //PHPMailer对象
        $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();  // 设定使用SMTP服务
        $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
                                                   // 1 = errors and messages
                                                   // 2 = messages only
        $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
        // $mail->SMTPSecure = 'ssl';                 // 使用安全协议
        $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
        $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
        $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
        $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
        $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
        $replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
        $replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
        $mail->AddReplyTo($replyEmail, $replyName);
        $mail->Subject    = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($to, $name);
        if(is_array($attachment)){ // 添加附件
            foreach ($attachment as $file){
                is_file($file) && $mail->AddAttachment($file);
            }
        }
        return $mail->Send() ? true : $mail->ErrorInfo;
    }

 ?>