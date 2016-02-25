<?php
/**
* 文章控制器 
*/

namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller{
	protected $rules=array(
			array('title','require','文章标题必须输入'),
			array('category','require','文章分类必须选择'),
		);
	public function _initialize(){
		
	}
 	public function index(){
 		// dump($_REQUEST);
 		$role=session('role');
 		$username=session("username");
 		$article=D('ArticleRelation');
		
		$category_id=I('category_id');
		$map=array();
		$condition=array();
		if ($username!='admin') {
			$map['category_id']=array('in',$role);
			$condition['id']=array('in',$role);
		}
		if (!Empty($category_id)) {
			// $map=array('category_id'=>$category_id);
			$map['category_id']=$category_id;
			if ($username!='admin' && !in_array($category_id, $role)) {
				$this->error('没有对此栏目的操作权限！');
			}
		}

		$count=$article-> where($map)-> count();
		$Page=new \Think\Page($count,10);

		foreach($map as $key=>$val) {
			$Page->parameter[$key]= urlencode($val);
		}
		// dump($Page->parameter);
		$this->pageinfo=$Page->show();

		$list=$article->relation(true)->where($map)->field('content',true)->limit($Page->firstRow.','.$Page->listRows)->order(array('top'=>'desc','id'=>'desc'))->select();
		$this->list=$list;

		$field=array('id','pid','title');
		import('Class.Category', APP_PATH);
		$category=new \Category('Category',$field);
		$order=array('sort'=>'asc','id'=>'asc');
		$list=$category->getList($condition,0,$order);
		$this->category=$list;

		$this->display();
	}
	public function add(){
		$role=session('role');
 		$username=session("username");

 		$condition=array();
		if ($username!='admin') {
			$condition['id']=array('in',$role);
		}		
		$field=array('id','pid','title');
		import('Class.Category', APP_PATH);
		$category=new \Category('Category',$field);
		$order=array('sort'=>'asc','id'=>'asc');
		$list=$category->getList($condition,0,$order);
		$this->category=$list;
		$this->display();
	}
	public function addHandle(){
		if (!IS_POST) {E('非法访问'); }
		$uploadPath=C('UPLOAD_ROOT_PATH').C('UPLOAD_SAVE_PATH');
		$uploadPath=substr($uploadPath,1);
		$ueditorPath="/Public/ueditor";
		// dump($uploadPath);
		// dump(__ROOT__ . '/' . $uploadPath);
		$content=I('content','','');
		$content_db=str_ireplace(__ROOT__ . $uploadPath, '__ROOT__'.$uploadPath, $content);
		$content_db=str_ireplace(__ROOT__ . $ueditorPath, '__ROOT__'.$ueditorPath, $content_db);
		// dump($content_db);
		$model=M('Article');
		if($model->validate($this->rules)->create()){
			$category_id=I('category_id');
			if (Empty($category_id)) {
				$this->error('文章分类必须选择');
			}
			cookie('category_id',$category_id);
			$model->create_time=time();
			$model->content=$content_db;
			$model->creator=session("userid");
			if($article_id=$model->add()){
				D('AttachmentRelation')->add($article_id,$content);
				systemLog(session('userid'), session('username'), '添加文章', '成功','id',$article_id);
				$this->success('添加成功！');
			}else{
				$this->error('添加失败！');
			}
		}else{
			$this->error($model->getError());
		}
	}
	public function edit($id=0){
		if ($id==0) {
			$this->error('请提供要编辑的文章id');
		}
		$role=session('role');
 		$username=session("username");

 		$condition=array();
		if ($username!='admin') {
			$condition['id']=array('in',$role);
		}			
		$field=array('id','pid','title');
		import('Class.Category', APP_PATH);
		$category=new \Category('Category',$field);
		$order=array('sort'=>'asc','id'=>'asc');
		$list=$category->getList($condition,0,$order);
		$this->category=$list;
		$list=M('Article')->find($id);
		$list['content']=str_ireplace('__ROOT__' , __ROOT__, $list['content']);
		$this->article=$list;
		// dump($list);
		$this->display();
	}
	public function update(){
		if (!IS_POST) {E('非法访问'); }
		$uploadPath=C('UPLOAD_ROOT_PATH').C('UPLOAD_SAVE_PATH');
		$uploadPath=substr($uploadPath,1);
		$ueditorPath="/Public/ueditor";
		// dump($uploadPath);
		// dump(__ROOT__ . '/' . $uploadPath);
		$content=I('content','','');
		$content_db=str_ireplace(__ROOT__ . $uploadPath, '__ROOT__'.$uploadPath, $content);
		$content_db=str_ireplace(__ROOT__ . $ueditorPath, '__ROOT__'.$ueditorPath, $content_db);
		// dump($content_db);
		$model=M('Article');
		if($model->validate($this->rules)->create()){
			$model->create_time=time();
			$model->content=$content_db;
			if (!isset($_POST['top'])) {
				$model->top=0;
			}

			if($article_id=$model->save()){
				D('AttachmentRelation')->update($article_id,$content);
				systemLog(session('userid'), session('username'), '修改文章', '成功' , 'id' , $article_id);
				$this->success('修改成功！', U('Admin/Article/index'));
			}else{
				$this->error('修改失败！');
			}
		}else{
			$this->error($model->getError());
		}
	}
	public function delete($id=0){
		if ($id==0) {
			$this->error('请提供要删除的文章id');
		}
		$list=M('Article')->find($id);
		$list['content']=str_ireplace('__ROOT__' , __ROOT__, $list['content']);

		D('AttachmentRelation')->delete($id, $list['content']);
		M('Article')->delete($id);
		systemLog(session('userid'), session('username'), '删除文章', '成功','id',$id);
		$this->success('删除成功', U('Admin/Article/index'));
	}
}
?>