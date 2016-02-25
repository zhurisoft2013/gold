<?php 
/**
* 公共控制器
*/
namespace Home\Controller;
use Think\Controller;
class CommonController  extends Controller{
	function _initialize() {
	    	$model=M('Category');
	    	$list=$model->field('id,title')->limit('12')->order(array('sort'=>'asc','id'=>'asc'))->select();
	    	// dump($list);
	    	$this->navlist=$list;

		if (isset($_GET['id'])) {
			$id=I('id');
			$condition=array('id'=>$id);
			// dump($condition);
			// $list=M('Article')->where($condition)->find();
			// dump($list);
			$cid=M('Article')->where($condition)->getField('Category_id');
			// $list2=getSubList($cid);
		}	    
	    	if (isset($_GET['cid'])) {
	    		$cid=I('cid');
	    		// $list2=getSubList($cid);    			
	    	}
	    	// dump($cid);
	    	$model=M('Category');
		$condition=array('id'=>$cid);
    		$list=$model->where($condition)->field('id,pid,title')->find();
    		$pid=$list['pid'];
    		$this->title=$list['title'];
    		if ($pid==0) {//如果是顶级元素，就列出它下面的栏目
    			$condition=array('pid'=>$cid);
    		}else{

    			$condition=array('pid'=>$cid);
    		}
    		// dump($condition);
		$list2=$model->field('id,title,pid,sort')->where($condition)->order(array('sort'=>'asc'))->select();
		// $sql=$model->getlastsql();
		// dump($sql);
	    	// dump($list2);
	    	$this->sublist_pid=$pid;
	    	$this->sublist=$list2;
	}
	private function getSubList($cid){
		$model=M('Category');
		$condition=array('id'=>$cid);
    		$pid=$model->where($condition)->getField('pid');
    		if ($pid==0) {
    			$condition=array('pid'=>$cid);
    		}else{
    			$conditoin=array('pid'=>$pid);
    		}
		$list=$model->field('id,title,pid,sort')->where($condition)->order(array('sort'=>'asc'))->select();
		return $list;
	}
}
 ?>