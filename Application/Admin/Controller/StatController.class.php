<?php
/**
* 统计控制器
*/
namespace Admin\Controller;
use Think\Controller;
class StatController extends Controller{
	public function category(){
		$field=array('id','pid','title');
		import('Class.Category', APP_PATH);
		$category=new \Category('Category',$field);
		$order=array('sort'=>'asc','id'=>'asc');
		$list=$category->getList(NULL,0,$order);
		$article=M('Article');
		foreach ($list as $key => $value) {
			$list[$key]['all_id']=getChildIds($list,$value['id']);
			array_unshift($list[$key]['all_id'], $value['id']);
			$map=array();
			$map['category_id']=array('in',$list[$key]['all_id']);
			$list[$key]['all_click']=$article->where($map)->sum('click');
			$list[$key]['count']=$article->where($map)->count();
		}
		// dump($list);
		$this->list=$list;
		$this->display();
	}
	public function user(){
		$field=array('id','username','nickname');
		$list=M('User')->field($field)->select();
		$article=M('Article');
		$now=time();
		foreach ($list as $key => $value) {
			$map=array();
			$map['creator']=$value['id'];
			$list[$key]['all_count']=$article->where($map)->count();
			$map['create_time']=array('gt',$now-7*24*60*60);
			$list[$key]['all_week_count']=$article->where($map)->count();
			$map['create_time']=array('gt',$now-30*24*60*60);
			$list[$key]['all_month_count']=$article->where($map)->count();
		}
		// dump($list);
		$this->list=$list;
		$this->display();
	}
	public function year(){
		$list=M('stat')->field('stat_year,sum(click) all_click')->group('stat_year')->select();
		$this->list=$list;
		// dump($list);
		$this->display();
	}
	public function month(){
		$year=I('year');
		$map=array('stat_year'=>$year);
		$list=M('stat')->where($map)->select();
		// dump($list);
		$this->list=$list;
		$this->display();
	}
}
?>