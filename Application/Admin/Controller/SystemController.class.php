<?php 
/**
* 系统设置控制器
*/
namespace Admin\Controller;
use Think\Controller;
class SystemController extends Controller {
	public function uploadSet() {
		// echo  C('THUMB');
		// echo C('UPLOAD_PATH');
		$this->display();
	}
	public function saveUploadSet(){
		if ($_POST['WATER']==1) {
			if (($_POST['WATER_TEXT'])=='') {
				$this->error('请输入水印文字');
			}
		}
		if ($_POST['WATER']==2) {
			if (($_POST['WATER_IMAGE'])=='') {
				$this->error('请输入水印图片的位置');
			}
		}


		$settingstr="<?php \n return array(\n";
		foreach($_POST as $key=>$v){
			$settingstr.= "\t'".$key."'=>'".$v."',\n";
		}
		$settingstr.=");\n?>\n";

		// 通过file_put_contents保存upload.php文件；
		$filename=CONF_PATH . 'upload.php';
		$settingstr=strip_whitespace("<?php\treturn " . var_export($_POST, true) . ";?>");
		//file_put_contents($filename, $settingstr);
		//\Think\Storage::put($filename,$settingstr,'F');
		if(\Think\Storage::put($filename,$settingstr,'F')){
			systemLog(session('userid'), session('username'), '修改设置', '成功');
			$this->success('设置成功',U('Admin/System/uploadSet'));
		}else{
			$this->error('设置写入失败');
		}


	}
}
 ?>