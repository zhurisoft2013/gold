<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 文章列表管理控制器
*/
class CategoryController extends Controller{
	protected $rules=array(
			array('title','require','分类名称必须提供！'),
			array('sort','require','分类顺序必须提供！'),
			array('sort','number','分类顺序必须是数字！')
			);
/*	public function _initialize(){
		$rules=array(
			array('title','require','分类名称必须提供！'),
			array('sort','require','分类顺序必须提供！'),
			array('sort','number','分类顺序必须是数字！')
			);
	}*/
	/**
	 * 类别信息列表
	 * @return [type] [description]
	 */
	public function index() {

		$field=array('id','pid','title');
		import('Class.Category', APP_PATH);
		$category=new \Category('Category',$field);
		$order=array('sort'=>'asc','id'=>'asc');
		$list=$category->getList(NULL,0,$order);
		// dump($list);

		$this->list=$list;
		$this->display();
	}

	public function add($pid=0){
		$field=array('id','pid','title');
		import('Class.Category', APP_PATH);
		$category=new \Category('Category',$field);
		$order=array('sort'=>'asc','id'=>'asc');
		$list=$category->getList(NULL,0,$order);
		$this->category=$list;
		$this->pid=$pid;
		$this->display();
	}
	public function addHandle(){
		$model=M('Category');
		if($model->validate($this->rules)->create()){
			$model->create_time=time();
			// dump($model);
			if ($model->category_id!=0) {
				$model->show_menu=0;
			}
			$result=$model->add();
			if($result){
				systemLog(session('userid'), session('username'), '添加分类', '成功','id',$result);
				$this->success('分类添加成功',U('Admin/Category/index'));
			}else{
				$this->error('分类添加失败');
				// dump($model->getlastsql());
			}
		}else{
			$this->error($model->getError());
		}
	}
	public function edit($id=0){
		if ($id==0) {
			$this->error('请提供要编辑的分类id');
		}
		$field=array('id','pid','title');
		import('Class.Category', APP_PATH);
		$category=new \Category('Category',$field);
		$order=array('sort'=>'asc','id'=>'asc');
		$list=$category->getList(NULL,0,$order);
		$this->category=$list;

		$list=M('Category')->find($id);
		$this->info=$list;
		$this->display();
	}
	public function update($id=0){
		if ($id==0) {
			$this->error('请提供要编辑的分类id');
		}
		$model=M('Category');
		if($model->validate($this->rules)->create()){
			if (!isset($_POST['show_menu'])) {
				$model->show_menu=0;
			}			
			
			if ($model->pid!=0) {
				$model->show_menu=0;
			}
			if($model->save()){
				systemLog(session('userid'), session('username'), '修改分类', '成功','id',$id);
				$this->success('修改成功！',U('Admin/Category/index'));
			}else{
				$this->error('修改失败！');
			}
		}else{
			$this->error($model>getError());
		}		
	}
	public function delete($id=0){
		if ($id==0) {
			$this->error('请提供要编辑的分类id');
		}
		$field=array('id','pid','title');
		import('Class.Category', APP_PATH);
		$category=M('Category')->field('id,title,pid')->select();
		
		$list=getChildIds($category, $id);
		$list[]=$id;

		$map['id']=array('in',$list);
		M('Category')->where($map)->delete();
		$map=array();
		$map['category_id']=array('in',$list);
		$article_list=M('Article')->where($map)->getfield('id',true);
		// dump($article_list);
		foreach ($article_list as $key => $value) {
			$content=M('Article')->where(array('id'=>$value))->getfield('content');
			// dump($content);
			$content=str_ireplace('__ROOT__' , __ROOT__, $content);
			D('AttachmentRelation')->delete($value, $content);
			M('Article')->delete($value);
		}
		

/*		foreach ($list as $key => $value) {
			M('Article')->where(array('category_id'=>$value))->delete();
			M('Category')->delete($value);
		}*/
		systemLog(session('userid'), session('username'), '删除分类', '成功','id',$id);
		$this->success('删除成功',U('Admin/Category/index'));
	}
}
?>