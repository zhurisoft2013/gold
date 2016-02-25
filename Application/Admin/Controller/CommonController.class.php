<?php 
/**
* 公共控制器
*/
namespace Admin\Controller;
use Think\Controller;
class CommonController  extends Controller{
	function _initialize() {

		if (!isset($_SESSION['userid']) || !isset($_SESSION['username'])) {
			cookie('url',__SELF__);
			$this->error('登录超时，请重新登录',U('Admin/Login/index'));
		}
	}
}
 ?>