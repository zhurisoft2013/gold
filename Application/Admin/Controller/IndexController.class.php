<?php 
/**
* 后台模块Index控制器
*/
namespace Admin\Controller;
use Think\Controller;

class IndexController extends CommonController{
 	public function index() {
/* 		$filetmpname = APP_PATH.'test.xlsx';
 		dump($filetmpname);
 		$excel=A('Excel');
 		$arr=$excel->read($filetmpname);
 		$model=M('Article');
 		foreach ($arr as $key => $value) {
 			$create_time=$value['create_time'];
 			// echo $oldtime . '<br />';
 			// $arr[$key]['create_time']=strtotime($create_time);
 			// $arr[$key]['content']=str_ireplace('/resource/editor/','__ROOT__/Public/uploads/',$value['content']);
 			$value['create_time']=strtotime($create_time);
 			$value['content']=str_ireplace('/resource/editor/','__ROOT__/Public/uploads/',$value['content']);
 			$model->add($value);
 		}*/
 		// M('Article')->addAll($arr);
 		// dump($arr);
		$this->display();
	}

}
 ?>