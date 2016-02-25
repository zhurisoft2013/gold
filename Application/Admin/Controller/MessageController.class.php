<?php
/**
* 留言信息控制器
*/
namespace Admin\Controller;
use Think\Controller;
class MessageController extends CommonController{
	public function index(){
		$message=D('MessageRelation');;
		$count=M('Message')->count();
		$Page=new \Think\Page($count,10);
		$this->pageinfo=$Page->show();
		$list=$message->relation(true)->limit($Page->firstRow.','.$Page->listRows)->order('time desc')->select();
		$this->message=$list;
		$this->display();
	}
	public function delete($id=0){
		if ($id==0) {
			$this->error('请提供留言id');
		}
		M('Message')->delete($id);
		$this->success('删除成功！',U('Admin/Message/index'));
	}
}
?>