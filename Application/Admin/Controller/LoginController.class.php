<?php 
/**
* 登录控制器
*/
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller{
	public function index(){

		$this->display();
	}
	public function verify(){
		$config	=array(
			'fontSize'=>14,
			'useCurve'=>false,
			'useNoise'=>false,
			'length'=>4,
			'imageW'=>110,
			'imageH'=>28,
			);
		$Verify=new \Think\Verify($config);
		$Verify->entry();
	}
	public function check(){
		if (!IS_POST) {E('页面不存在'); }
		$username=I('username');
		$password=I('password','','md5');
		$code=I('code','','');

		$verify=new \Think\Verify();
		if (!$verify->check($code)) {
			$this->error('验证码错误！');
		}
		$model=M('user');
		$field=array('id','username','nickname','password','role');
		$user=$model->where(array('username'=>$username))->field($field)->find();
		// dump($password);
		// dump($user); 
		if($user===null){
			systemLog('', $username, '用户登录', '失败','用户不存在',$username);
			$this->error('用户不存在！');
		}
		if ($user['password']!=$password) {
			systemLog($user['id'], $username, '用户登录', '失败','密码错误',I('password'));
			$this->error('密码错误！');
		}
		$data=array(
			'id'=>$user['id'],
			'logintime'=>time(),
			'loginip'=>get_client_ip(),
			);
		$model->save($data);
		session('userid',$data['id']);
		session('username',$user['username']);
		session('nickname', $user['nickname']);
		$role=$user['role'];
		$role=explode(',', $role);
		session('role',$role);
		systemLog($user['id'], $username, '用户登录', '成功');
		// $this->success('登录成功！',U('Admin/Index/index'));
		$url=cookie('url');
		if ($url=='') {
			$url=U('Admin/Index/index');
		}
		cookie('url',null);
		// dump($url);
		redirect($url);		
	}
	//注销
	public function logout(){
		session_unset();	
		session_destroy();
		$this->redirect('Admin/Login/index');
	}
}
 ?>