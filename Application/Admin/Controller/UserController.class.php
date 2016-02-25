<?php
/**
* 用户控制器
*/
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController{

	public function changePWD(){
		$this->display();
	}
	public function savePWD(){
		$model=M('User');
		$user=$model->where(array('id'=>session('userid')))->find();

		$orgpwd=I('orgpwd','','md5');
		$newpwd=I('newpwd');
		$repwd=I('repwd');
		// $this->error($orgpwd);
		if ($user['password']!=$orgpwd) {
			$this->error('原密码错误！');
		}
		if ($newpwd!=$repwd) {
			$this->error('新密码和确认密码不一致！');
		}
		$data=array(
			'id'=>session('userid'),
			'password'=>md5($newpwd),
			);
		M('User')->save($data);

		// $this->ajaxReturn($data);
		$this->success('修改成功!!!!!!');
	}

	public function index(){
		$model=M('User');
		$count=$model->count();
		$Page=new \Think\Page($count,10);

		$this->pageinfo=$Page->show();

		$field=array('id','username','nickname','status');

		$list=$model->field($field)->limit($Page->firstRow.','.$Page->listRows)->order(array('id'=>'asc'))->select();

		
		$this->list=$list;
		$this->display();
	}
	public function add(){
		$category=M('Category')->field('id,title,pid')->order(array('id'=>'asc'))->select();

		$category=category_merge($category);
		// dump($category);
		$this->category=$category;
		$this->display();
	}
	public function addHandle(){
		$username=I('username','');
		$nickname=I('nickname');
		$password=I('password');
		$status=I('status');
		$role=I('role');
		$role=implode(',' , $role);
		if ($username=='') {
			$this->error('用户名必须输入');
		}
		$model=M('User');
		$condition=array('username' => $username);
		if ($model->where($condition)->find()) {
			$this->error('用户名已经存在！请改名！');
		}
		$data=array(
			'username' => $username,
			'nickname' => $nickname,
			'password' => md5($password),
			'status' => $status,
			'role' => $role
			);
		// dump($data);
		if ($model->add($data)) {
			$this->success('添加成功！',U('Admin/User/index'));
		}else{
			$this->error('添加失败！');
		}
		
	}
	public function edit($id=0){
		if ($id==0) {
			$this->error('请提供要编辑的用户id！');
		}
		if ($id==1) {
			$this->error('管理员不允许修改！');
		}

		$field=array('id','username','nickname','status','role');
		$map=array('id'=>$id);
		$user=M('User')->field($field)->where($map)->find();
		// dump($user);
		$role=$user['role'];
		$role=explode(',', $role);
		// dump($role);
		$this->role=$role;

		// dump($user);
		$this->user=$user;
		$category=M('Category')->field('id,title,pid')->order(array('id'=>'asc'))->select();

		$category=category_merge($category);
		// dump($category);
		$this->category=$category;		
		$this->display();
	}
	public function update(){
		if (!IS_POST) {E('非法访问'); }
		$id=I('id');
		if ($id==0) {
			$this->error('请提供要编辑的用户id！');
		}
		if ($id==1) {
			$this->error('管理员不允许修改！');
		}
		$nickname=I('nickname');
		$status=I('status');
		$role=I('role');
		$role=implode(',' , $role);

		$model=M('User');

		$data=array(
			'id' => $id,
			'nickname' => $nickname,
			'status' => $status,
			'role' => $role
			);
		// dump($data);
		if ($model->save($data)) {
			$this->success('修改成功！',U('Admin/User/index'));
		}else{
			$this->error('修改失败！');
		}		

	}
	public function delete ($id=0){
		// if (!IS_POST) {E('非法访问'); }
		if ($id==0) {
			$this->error('请提供要删除的用户id！');
		}
		M('User')->delete($id);
		$this->success('删除成功！',U('Admin/User/index'));
		
	}
	public function editPWD($id=0){
		if ($id==0) {
			$this->error('请提供要编辑的用户id！');
		}
		if ($id==1) {
			$this->error('管理员不允许修改！');
		}

		$field=array('id','username','nickname');
		$map=array('id'=>$id);
		$user=M('User')->field($field)->where($map)->find();

		$this->user=$user;
	
		$this->display();
	}
	public function updPWD(){
		if (!IS_POST) {E('非法访问'); }
		$id=I('id');
		if ($id==0) {
			$this->error('请提供要编辑的用户id！');
		}
		if ($id==1) {
			$this->error('管理员不允许修改！');
		}
		$password=I('password');
		$repassword=I('repassword');
		if ($password!=$repassword) {
			$this->error('密码和确认密码不一致！');
		}
		$model=M('User');

		$data=array(
			'id' => $id,
			'password' => md5($password),
			);
		// dump($data);
		if ($model->save($data)) {
			$this->success('修改成功！',U('Admin/User/index'));
		}else{
			$this->error('修改失败！');
		}		

	}
}
?>