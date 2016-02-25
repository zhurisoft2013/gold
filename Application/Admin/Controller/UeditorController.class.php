<?php
/**
* 百度编辑器控制器
*/
/*
CREATE TABLE IF NOT EXISTS `my_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL DEFAULT 'unknown' COMMENT '模块',
  `controller` varchar(20) NOT NULL DEFAULT 'unknown' COMMENT '控制器',
  `action` varchar(20) NOT NULL DEFAULT 'unknown' COMMENT '操作',
  `filename` varchar(50) NOT NULL DEFAULT '' COMMENT '文件名',
  `filepath` varchar(100) NOT NULL COMMENT '文件路径',
  `filesize` int(10) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `fileext` char(10) NOT NULL DEFAULT '' COMMENT '文件扩展名',
  `isimage` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是图片',
  `userid` int(11) DEFAULT '0' COMMENT '上传的用户id',
  `createtime` int(10) NOT NULL COMMENT '上传时间',
  `ip` char(15) NOT NULL COMMENT '上传ip',
  `cite` tinyint(4) NOT NULL COMMENT '是否引用',
  `ori_filename` varchar(45) NOT NULL DEFAULT '' COMMENT '原文件名',
  `fullfilename` varchar(160) NOT NULL DEFAULT '' COMMENT '完整路径文件',
  `hash` char(32) NOT NULL DEFAULT '' COMMENT '哈希值',
  `download` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='上传附件表' AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `my_article_attachment` (
  `article_id` int(11) NOT NULL COMMENT '图书id',
  `attachment_id` int(11) NOT NULL COMMENT '附件id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '图片标题',
  `description` varchar(45) NOT NULL DEFAULT '' COMMENT '图片描述',
  `url` varchar(100) NOT NULL DEFAULT '',
  `sort` int(10) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`attachment_id`,`article_id`),
  KEY `fk_my_book_has_my_attachment_my_attachment1_idx` (`attachment_id`),
  KEY `fk_my_book_has_my_attachment_my_book1_idx` (`article_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图书图片表' AUTO_INCREMENT=1 ;

*/

namespace Admin\Controller;
use Think\Controller;
class UeditorController extends Controller{
	
	private $thumb;//缩略图模式(看手册)
	private $water;	//是否加水印(0:无水印,1:水印文字,2水印图片)
	private $waterImage;  //水印图片文件 
	private $waterText;//水印文字
	private $waterPosition;//水印位置
	private $savePath; //保存位置
	private $userid; //操作用户名
	private $module; //操作模块
	private $Controller;//操作控制器
	private $action;  //操作

	public function _initialize(){
		// 此处因为swfupload控件无法传递sessoin，所以只好采用文件缓存的办法来传递相应信息
		// $data=F('uploadData');
		// $this->userid=$data['userid'];
		// $this->module=$data['module'];
		// $this->action=$data['action'];

		$this->userid=empty($_SESSION['userid'])? $_GET['userid'] : $_SESSION['userid'];
		if(empty($this->userid)){
			$this->userid= 'anonymity';
		}

		$this->module=$_GET['module'];
		$this->controller=$_GET['controller'];
		$this->action=$_GET['actionname'];

		$this->rootPath=C('UPLOAD_ROOT_PATH',null, './Public/uploads/');
		$this->savePath=C('UPLOAD_SAVE_PATH',null,'');
		// $this->thumb=C('THUMB')==''?1:C('THUMB');
		$this->thumb=C('THUMB', null, 1);
		// $this->water=C('WATER')==''?0:C('WATER');
		$this->water=C('WATER', null, 0);
		$this->waterText=C('WATER_TEXT');
 		$this->waterImage=C('WATER_IMAGE');
 		// $this->waterPosition=C('WATER_POSITION')==''?9:C('WATER_POSITION');
 		$this->waterPosition=C('WATER_POSITION', null, 9);

/* 		$this->water=1;
		$this->waterText='逐日软件';*/
	}

	public function index(){

		$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(CONF_PATH."config.json")), true);

		$action = htmlspecialchars($_GET['action']);
		switch ($action) {
		    case 'config':
		        $result =  json_encode($CONFIG);
		        break;

		    /* 上传图片 */
		    case 'uploadimage':
		        $config = array(
		            "pathFormat" => $CONFIG['imagePathFormat'],
		            "maxSize" => $CONFIG['imageMaxSize'],
		            "allowFiles" => $CONFIG['imageAllowFiles']
		        );
		        $fieldName = $CONFIG['imageFieldName'];
		        $result=$this->upFile($config, $fieldName);
		        break;

		    /* 上传涂鸦 */
		    case 'uploadscrawl':
		        $config = array(
		            "pathFormat" => $CONFIG['scrawlPathFormat'],
		            "maxSize" => $CONFIG['scrawlMaxSize'],
		            "allowFiles" => $CONFIG['scrawlAllowFiles'],
		            "oriName" => "scrawl.png"
		        );
		        $fieldName = $CONFIG['scrawlFieldName'];
		        $base64 = "base64";
		        $result=$this->upBase64($config,$fieldName);
		        break;

		    /* 上传视频 */
		    case 'uploadvideo':
		        $config = array(
		            "pathFormat" => $CONFIG['videoPathFormat'],
		            "maxSize" => $CONFIG['videoMaxSize'],
		            "allowFiles" => $CONFIG['videoAllowFiles']
		        );
		        $fieldName = $CONFIG['videoFieldName'];
		        $result=$this->upFile($config, $fieldName);
		        break;

		    /* 上传文件 */
		    case 'uploadfile':
		    // default:
		        $config = array(
		            "pathFormat" => $CONFIG['filePathFormat'],
		            "maxSize" => $CONFIG['fileMaxSize'],
		            "allowFiles" => $CONFIG['fileAllowFiles']
		        );
		        $fieldName = $CONFIG['fileFieldName'];
		        $result=$this->upFile($config, $fieldName);
		        break;

		    /* 列出图片 */
		    case 'listimage':
			$allowFiles = $CONFIG['imageManagerAllowFiles'];
			$listSize = $CONFIG['imageManagerListSize'];
			$path = $CONFIG['imageManagerListPath'];
			$get=$_GET;
			$result =$this->file_list($allowFiles, $listSize, $get);
		        	break;
		    /* 列出文件 */
		    case 'listfile':
			$allowFiles = $CONFIG['fileManagerAllowFiles'];
			$listSize = $CONFIG['fileManagerListSize'];
			$path = $CONFIG['fileManagerListPath'];
			$get=$_GET;
			$result =$this->file_list($allowFiles, $listSize, $get);
	    	            break;

		    /* 抓取远程文件 */
		    case 'catchimage':
		    	$config = array(
			    "pathFormat" => $CONFIG['catcherPathFormat'],
			    "maxSize" => $CONFIG['catcherMaxSize'],
			    "allowFiles" => $CONFIG['catcherAllowFiles'],
			    "oriName" => "remote.png"
			);
			$fieldName = $CONFIG['catcherFieldName'];
			/* 抓取远程图片 */
			$list = array();
			if (isset($_POST[$fieldName])) {
			    $source = $_POST[$fieldName];
			} else {
			    $source = $_GET[$fieldName];
			}
			foreach ($source as $imgUrl) {
			    $info=json_decode($this->saveRemote($config, $imgUrl),true);
			    // dump($info);
			    array_push($list, array(
			        "state" => $info["state"],
			        "url" => $info["url"],
			        "size" => $info["size"],
			        "title" => htmlspecialchars($info["title"]),
			        "original" => htmlspecialchars($info["original"]),
			        "source" => htmlspecialchars($imgUrl)
			    ));
			}

			$result= json_encode(array(
			    'state'=> count($list) ? 'SUCCESS':'ERROR',
			    'list'=> $list
			));
		        break;

		    default:
		        $result = json_encode(array(
		            'state'=> '请求地址出错'
		        ));
		        break;
		}

		/* 输出结果 */
		if (isset($_GET["callback"])) {
		    if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
		        echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
		    } else {
		        echo json_encode(array(
		            'state'=> 'callback参数不合法'
		        ));
		    }
		} else {
		    echo $result;
		}

	}
	/**
	     * 上传文件的主处理方法
	     * @return mixed
	     */
	private function upFile($config,$fieldName){
		$conf=array(
			'rootPath' => $this->rootPath,
			'savePath' => $this->savePath,
			'autoSub' => true,
			'subName'=>$this->userid . '/' . date('Ym',time()) ,// 子目录命名的规则为 用户名/年月/
			'maxSize'=>$config['maxSize'],
			'exts'=>$this->format_exts($config['allowFiles']),//去除扩展名前的点 .
			);

		$upload=new \Think\Upload($conf);
/*		if(isset($_REQUEST['PHPSESSID'])){
			session_id($_REQUEST['PHPSESSID']);
			session('[pause]');
			session('[start]');
			 // file_put_contents('./test.txt', 'PHP:' . $_SESSION['userid']);
			$this->userid=empty($_SESSION['userid'])? 'anonymity' : $_SESSION['userid'];
			$this->module=session('module');
			$this->controller=session('controller');
			$this->action=session('action');
		}*/
		$info=$upload->uploadOne($_FILES[$fieldName]);
		if($info){
			$fname=$upload->rootPath .$info['savepath'].$info['savename'];
			$imagearr = explode(',', 'jpg,gif,png,jpeg,bmp,ttf,tif'); 
			$info['ext']= strtolower($info['ext']);

			$isimage = in_array($info['ext'],$imagearr) ? 1 : 0;
			if ($isimage) {
				$image=new \Think\Image();

				$image->Open($fname);
				$image->thumb(620,620,$this->thumb)->save($fname);

				if ($this->water==1) {
					$image->text($this->waterText,'./Public/font/STXINGKA.TTF',18,'#9a9a9a',$this->waterPosition,array(-2,0))->save($fname); 
				}
				if ($this->water==2) {
					$image->water($this->waterImage)->save($fname);
				}	
			}
			$data=array(
				'filename' =>  $info['savename'],
				'filepath' => $info['savepath'] ,
				'filesize'	 => $info['size'],
				'fileext' =>  strtolower($info['ext']),

				'ori_filename' => $info['name'],				
				'fullfilename' => strtolower(substr($fname,1)),
				'hash' => $info['md5'],	
				);
			
			$this->uploadLog($data);
			/**
			 * 得到上传文件所对应的各个参数,数组结构
			 * array(
			 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
			 *     "url" => "",            //返回的地址
			 *     "title" => "",          //新文件名
			 *     "original" => "",       //原始文件名
			 *     "type" => ""            //文件类型
			 *     "size" => "",           //文件大小
			 * )
			 */
			$data=array(
				'state'=>'SUCCESS',
				'url'=>__ROOT__. strtolower(substr($fname,1)),
				'title'=>$info['savename'],
				'original'=>$info['name'],
				'type'=>'.' . $info['ext'],
				'size'=>$info['size'],
				);
		}else{
			$data=array(
				'state'=>$upload->getError(),
				);
		}
		return json_encode($data);
	}

	/**
	 * 处理base64编码的图片上传
	 * @return mixed
	 */
	private function upBase64($config,$fieldName)
	{
	    $base64Data = $_POST[$fieldName];
	    $img = base64_decode($base64Data);

	    $dirname=$this->rootPath . $this->savePath . $this->userid . '/scrawl/';
	    $file['filesize']=strlen($img);
	    $file['oriName']=$config['oriName'];
	    $file['ext']=strtolower(strrchr($config['oriName'], '.'));
	    $file['name']= uniqid() .  $file['ext'];
	    $file['fullName']=$dirname . $file['name'];
	    $fullName=$file['fullName'];
	    // dump($file);

 	//检查文件大小是否超出限制
	    if ($file['filesize'] >= ($config["maxSize"])) {
  		$data=array(
			'state'=>'文件大小超出网站限制',
		);
		return json_encode($data);
	    }

	    //创建目录失败
	    if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
	           $data=array(
			'state'=>'目录创建失败',
		);
		return json_encode($data);
	    } else if (!is_writeable($dirname)) {
	         $data=array(
			'state'=>'目录没有写权限',
		);
		return json_encode($data);
	    }

	    //移动文件
	    if (!(file_put_contents($fullName, $img) && file_exists($fullName))) { //移动失败
        	         $data=array(
		'state'=>'写入文件内容错误',
		);
	    } else { //移动成功

		$data=array(
			'filename' =>  $file['name'],
			'filepath' =>  $dirname,
			'filesize'	 => $file['filesize'],
			'fileext' =>  strtolower($file['ext']),

			'ori_filename' => $file['name'],				
			'fullfilename' => strtolower(substr($file['fullName'],1)),
			'hash' =>$file['name'],	
			);
		
		$this->uploadLog($data);

	        	$data=array(
			'state'=>'SUCCESS',
			'url'=>__ROOT__ . substr($file['fullName'],1),
			'title'=>$file['name'],
			'original'=>$file['oriName'],
			'type'=>$file['ext'],
			'size'=>$file['filesize'],
		);
	    }
	    return json_encode($data);
	}

	/**
	 * 拉取远程图片
	 * @return mixed
	 */
	private function saveRemote($config, $fieldName)
	{
	    $imgUrl = htmlspecialchars($fieldName);
	    $imgUrl = str_replace("&amp;", "&", $imgUrl);

	    //http开头验证
	    if (strpos($imgUrl, "http") !== 0) {
	         $data=array(
		'state'=>'链接不是http链接',
		);
	         return json_encode($data);
	    }
	    //获取请求头并检测死链
	    $heads = get_headers($imgUrl);
	    if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
	         $data=array(
		'state'=>'链接不可用',
		);
	         return json_encode($data);
	    }
	    //格式验证(扩展名验证和Content-Type验证)
	    $fileType = strtolower(strrchr($imgUrl, '.'));
	    if (!in_array($fileType, $config['allowFiles']) || stristr($heads['Content-Type'], "image")) {
	        $data=array(
		'state'=>'链接contentType不正确',
		);
	         return json_encode($data);
	    }

	    //打开输出缓冲区并获取远程图片
	    ob_start();
	    $context = stream_context_create(
	        array('http' => array(
	            'follow_location' => false // don't follow redirects
	        ))
	    );
	    readfile($imgUrl, false, $context);
	    $img = ob_get_contents();
	    ob_end_clean();
	    preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $imgUrl, $m);

	    $dirname=$this->rootPath . $this->savePath . $this->userid . '/remote/';
	    $file['oriName']=$m ? $m[1]:"";
	    $file['filesize']=strlen($img);
	    $file['ext']=strtolower(strrchr($config['oriName'], '.'));
	    $file['name']= uniqid() .  $file['ext'];
	    $file['fullName']=$dirname . $file['name'];
	    $fullName=$file['fullName'];

	    //检查文件大小是否超出限制
	    if ($file['filesize'] >= ($config["maxSize"])) {
  		$data=array(
			'state'=>'文件大小超出网站限制',
		);
		return json_encode($data);
	    }

	    //创建目录失败
	    if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
  		$data=array(
			'state'=>'目录创建失败',
		);
		return json_encode($data);
	    } else if (!is_writeable($dirname)) {
  		$data=array(
			'state'=>'目录没有写权限',
		);
		return json_encode($data);
	    }

	    //移动文件
	    if (!(file_put_contents($fullName, $img) && file_exists($fullName))) { //移动失败
  		$data=array(
			'state'=>'写入文件内容错误',
		);
		return json_encode($data);
	    } else { //移动成功

		$data=array(
			'filename' =>  $file['name'],
			'filepath' =>  $dirname,
			'filesize'	 => $file['filesize'],
			'fileext' =>  ltrim(strtolower($file['ext']),'.'),

			'ori_filename' => $file['oriName'],				
			'fullfilename' => strtolower(substr($file['fullName'],1)),
			'hash' =>$file['name'],	
			);
		
		$this->uploadLog($data);

	    	
	       	 $data=array(
			'state'=>'SUCCESS',
			'url'=>__ROOT__ . substr($file['fullName'],1),
			'title'=>$file['name'],
			'original'=>$file['oriName'],
			'type'=>$file['ext'],
			'size'=>$file['filesize'],
		);
	    }
	    return json_encode($data);
	}
	private function file_list($allowFiles, $listSize, $get){
		$dirname=$this->rootPath . $this->savePath ;
		if ($this->userid!='admin') {
			$dirname.=$this->userid . '/';
		}
		$allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);

		/* 获取参数 */
		$size = isset($get['size']) ? htmlspecialchars($get['size']) : $listSize;
		$start = isset($get['start']) ? htmlspecialchars($get['start']) : 0;
		$end = $start + $size;

		/* 获取文件列表 */
		// $path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "":"/") . $path;
		$path=$dirname;
		$files = $this->getfiles($path, $allowFiles);
		if (!count($files)) {
		    return json_encode(array(
		        "state" => "no match file",
		        "list" => array(),
		        "start" => $start,
		        "total" => count($files)
		    ));
		}

		/* 获取指定范围的列表 */
		$len = count($files);
		for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
		    $list[] = $files[$i];
		}
		//倒序
		//for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
		//    $list[] = $files[$i];
		//}

		/* 返回数据 */
		$result = json_encode(array(
		    "state" => "SUCCESS",
		    "list" => $list,
		    "start" => $start,
		    "total" => count($files)
		));

		return $result;
	}

   	 /**
	     * 遍历获取目录下的指定类型的文件
	     * @param $path
	     * @param array $files
	     * @return array
	     */
	    private function getfiles( $path , $allowFiles, &$files = array() ) {
	        if ( !is_dir( $path ) ) return null;
	        if(substr($path, strlen($path) - 1) != '/') $path .= '/';
	        $handle = opendir( $path);
	        while ( false !== ( $file = readdir( $handle ) ) ) {
	            if ( $file != '.' && $file != '..' ) {
	                $path2 = $path . $file;
	                if ( is_dir( $path2)) {
	                    $this->getfiles( $path2 ,$allowFiles,  $files );
	                } else {
		                if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
		                    $files[] = array(
		                        'url'=> __ROOT__ . substr($path2, 1),
		                        'mtime'=> filemtime($path2)
		                    );
		                }
	                }
	            }
	        }
	        return $files;
	    }
	    /**
	     * [formatUrl 格式化url，用于将getfiles返回的文件路径进行格式化，起因是中文文件名的不支持浏览]
	     * @param  [type] $files [文件数组]
	     * @return [type]        [格式化后的文件数组]
	     */
	    private function formatUrl($files){
	    	if(!is_array($files)) return $files;
	    	foreach ($files as  $key => $value) {
	    		$data=array();
	    		$data=explode('/', $value);
	    		foreach ($data as $k=>$v) {
	    			if($v!='.' && $v!='..'){
	    				$data[$k]=urlencode($v);
	    				$data[$k] = str_replace("+", "%20", $data[$k]); 
	    			}
	    		}
	    		$files[$key]=implode('/', $data);
	    	}
	    	return $files;
	    }	


	private function format_exts($exts){
		$data=array();
		foreach ($exts as $key => $value) {
			$data[]=ltrim($value,'.');
		}
		return $data;
	}

	    /**
	     * [uploadLog 将附件信息加入到数据库中]
	     * @param  [type] $data [description]
	     * @return [type]       [description]
	     */
	    private function uploadLog($data){
		$imagearr = explode(',', 'jpg,gif,png,jpeg,bmp,ttf,tif'); 
		$model = M('Attachment');
		//保存当前数据对象
		
		$this->module=empty($this->module)? 'unknown' : $this->module;
		$this->controller=empty($this->controller)? 'unknown' : $this->controller;
		$this->action=empty($this->action)? 'unknown' : $this->action;
		
		$data['module'] = $this->module;
		$data['controller'] = $this->controller;
		$data['action'] =$this->action;
		$data['userid'] =$this->userid;

		$data['isimage'] = in_array($data['fileext'],$imagearr) ? 1 : 0;
		$data['createtime'] = time();
		$data['ip'] = get_client_ip();
		// dump($data);
		$aid = $model->add($data); 
		 // file_put_contents('./test.txt', session('admin'));
		return $aid;
	    }

	public function write_conf($config=''){
		if ($config=='') {
			$config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
		}
/*		$settingstr="<?php \n return array(\n";
		foreach($config as $key=>$v){
			
			$settingstr.= "\t'".$key."'=>'".$v."',\n";
		}
		$settingstr.=");\n?>\n";*/

		// 通过file_put_contents保存upload.php文件；
		$filename=CONF_PATH . 'ueditor.php';
		 $settingstr=strip_whitespace("<?php\treturn " . var_export($config, true) . ";?>");
		// dump($settingstr);
		//file_put_contents($filename, $settingstr);
		//\Think\Storage::put($filename,$settingstr,'F');
		if(\Think\Storage::put($filename,$settingstr,'F')){
			$this->success('设置成功');
		}else{
			$this->error('设置写入失败');
		}
	}

}
?>