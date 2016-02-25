<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
            // echo date('Y-m-d H:i:s',"1393377780");
            
            // echo strtotime('2014/7/16 20:27:16');
/*    	$list=D('CategoryRelation')->relation(true)->where(array('pid'=>0))->order(array('sort'=>'asc','id'=>'asc'))->select();
    	$this->category_list=$list;*/
            $model=M('Article');
            $field=array('id','pid','title');
            $category_list=M('Category')->field($field)->where(array('pid'=>0))->order(array('sort'=>'asc','id'=>'asc'))->select();
            // dump($category_list);
             $field=array('id','pid','title');
             import('Class.Category', APP_PATH);
            $category=new \Category('Category',$field);
            $order=array('sort'=>'asc','id'=>'asc');
            $list=$category->getList(NULL,0,$order);

            foreach ($category_list as $key => $value) {
                $ids=getChildIds($list,$value['id']);
                array_unshift($ids,$value['id']);
                $map['category_id']=array('in',$ids); 
                $category_list[$key]['Article']=$model->limit(5)->where($map)->order(array('top'=>'desc','create_time'=>'desc'))->select();           
            }

            $this->category_list=$category_list;

            $this->display();
           
    }
    public function sendmail(){
        $to='376417318@qq.com';
        $name='小明';
        $subject='标题';
        $body='body';
        think_send_mail($to, $name, $subject , $body);
        // send_mail($subject,$body);
    }
    public function articleList($cid=0){
            $article=D('ArticleRelation');
             if (Empty($cid)) {
                $map=array();
            }else{
                $field=array('id','pid','title');
                 import('Class.Category', APP_PATH);
                $category=new \Category('Category',$field);
                $order=array('sort'=>'asc','id'=>'asc');
                $list=$category->getList(NULL,0,$order);
                // $list=M('Category')->where($field)->select();
                $ids=getChildIds($list,$cid);
                array_unshift($ids,$cid);
                // dump($ids);
                $map['category_id']=array('in',$ids);
                // $map=array('category_id'=>$cid);
                // dump($map);
            }

            $count=$article-> where($map)-> count();
            $Page=new \Think\Page($count,15);

            foreach($map as $key=>$val) {
                $Page->parameter[$key]= urlencode($val);
            }            
            $this->pageinfo=$Page->show();


    	// $list=$article->relation(true)->Where(array('category_id'=>$cid))->limit($Page->firstRow.','.$Page->listRows)->order(array('sort'=>'asc','id'=>'desc'))->select();
            $list=$article->relation(true)->Where($map)->limit($Page->firstRow.','.$Page->listRows)->order(array('top'=>'desc','id'=>'desc'))->select(); 
    	$model=M('Category');
    	$category_name=$model->where(array('id'=>$cid))->getField('title');
    	// dump($model->getlastsql());
    	$this->category_name=$category_name;
    	$this->article_list=$list;
    	$this->display();
    }
    public function article($id=0){
    	if ($id==0) {
    		$this->error('请提供需要浏览的文章id');
    	}
            $this->stat();
    	$article=D('ArticleRelation')->relation(true)->find($id);
    	$article['content']=str_ireplace('__ROOT__' , __ROOT__, $article['content']);
            M('Article')->where(array('id'=>$id))->setInc('click');
    	$this->article=$article;
    	$this->display();
    }
    public function search(){
        $q=I('q');
        $map['content']=array('like',"%$q%");
        $map['title']=array('like',"%$q%");   
        $map['_logic'] = 'or';     
        // dump($map);
        // $list=M('Article')->where($map)->select();
        $model=D('ArticleRelation');
        $list=$model->relation(true)->where($map)->select();
        // dump($model->getlastsql());
        // dump($list);
        foreach ($list as $key => $value) {
            $content=strip_tags($value['content']);
            $content=str_ireplace($q,'<strong>'.$q.'</strong>',$content);
            // dump($content);
            $i=mb_stripos($content, '<strong>');
            // dump($i);
            $content=mb_substr($content, 0, 220, 'utf-8');
            // $content.='</strong>';
            // dump($content);
            $list[$key]['content']=$content;
        }
        $this->list=$list;
        $this->display();

    }
    private function stat(){
        $year=date('Y',time());
        $month=date('Y-m',time());
        $map=array('stat_month'=>$month);
        $result=M('stat')->where($map)->find();
        if ($result) {
            M('Stat')->where($map)->setInc('click');
        }else{
            $data=array(
                'stat_year'=>$year,
                'stat_month'=>$month,
                );
            M('stat')->add($data);
        }
    }
    /**
     * 上传图片测试
     * @return [type] [description]
     */
    //上传图片
    public function upload_pic(){
        // header("Content-type: text/html; charset=utf-8");
        // dump($_POST);
        // exit();
        $upfile=I('upfile');
        $title=I('title');
        $declaration=I('declaration');
        $uname=I('uname');
        $edu=I('edu');
        $contact=I('contact');
        $community=I('community');

        /*if (empty($upfile)) {
             $this->error('全家福照片必须提供');
        }*/
        if (empty($title)) {
            $this->error('梦想名称必须输入');
             // echo("<script>alert('梦想名称必须输入');history.back();</script>");
             // exit();
        }

        if (empty($declaration)) {
            $this->error('梦想宣言必须输入');
             // echo("<script>alert('梦想宣言必须输入');history.back();</script>");
             // exit();
        }
        if (empty($uname)) {
            $this->error('家庭团队代表姓名必须输入');
             // echo("<script>alert('家庭团队代表姓名必须输入');history.back();</script>");
             // exit();
        }
        if (empty($contact)) {
            $this->error('联系方式必须提供');
             // echo("<script>alert('联系方式必须提供');history.back();</script>");
             // exit();
        }
         if (empty($community)) {
            $this->error('所在社区必须提供');
             // echo("<script>alert('所在社区必须提供');history.back();</script>");
             // exit();
        }       
       
        // echo($title);
        // echo($upfile);
        //exit();

        $path="./Public/uploads/";
        // $path=C('UPLOAD_ROOT_PATH');
        $upload=new \Think\Upload();
        $upload->rootPath=$path;
        $upload->maxSize=5 *1024*1024;
        $upload->exts=array('jpg','gif','png');
        $upload->savePath='Pic/';
        $upload->autoSub=false;

        $info=$upload->uploadOne($_FILES['upfile']);
        if ($info) {
            $image=new \Think\Image();          
            $fname=substr($path, 1) .$upload->savePath . $info['savename'];
            $image->Open('.' . $fname);

            $f=pathinfo($fname);

            $dirname=$f['dirname'];
            $filename=$f['basename'];
            $newfile=$dirname .'/small/'.$filename;

            $image->thumb(300,223,1)->save('.'.$newfile);
            $fname=$newfile;
           /* $data=array(
                'module'=>'Admin',
                'controller'=>'Book',
                'action'=>'upload_pic',
                'filename' =>  $info['savename'],
                'filepath' => $info['savepath'],
                'filesize'   => $info['size'],
                'fileext' =>  strtolower($info['ext']),
                'isimage'=>'1',
                'userid'=>session('userid'),
                'createtime'=>time(),
                'ip'=>get_client_ip(),
                'cite'=>1,
                'ori_filename' => $info['name'],
                'fullfilename' => strtolower($fname),
                'fullfilename'=>$fname,
                'hash' => $info['md5'],
                'cite'=>1,
                );
                $model=M('Attachment');
                $aid=$model->add($data);*/

            $data=array(
                'title'=>$title,
                'declaration'=>$declaration,
                'uname'=>$uname,
                'edu'=>$edu,
                'contact'=>$contact,
                'community'=>$community,
                'photo'=>$fname,
                );
            dump($data);
            $result=M('sign')->add($data);
            dump($result);
            if ($result) {
               $this->display('result');
            }else{
                $this->error('报名失败');
            }
               /* $data=array(
                    'bid'=>$id,
                    'aid'=>$aid,
                    'url'=>$fname,
                    );
                $pid=M('book_attachment')->add($data);*/

            /*$data=array(
                'url'=>__ROOT__.$fname,
                'fileType'=>'.' . $info['ext'],
                'original'=>$info['name'],
                'state'=>'SUCCESS',

                'status'=>1,
                'filepath' => $fname,
                'name' =>  $info['name'],
                'username' => session('username'),
                'info'=>'上传成功',
                'pid'=>$pid,
                );*/
        }else{
            $data=array(
                'state'=>$upload->getError(),
                'status' => 0,
                'info'=>$upload->getError(),
                ); 
                $this->error($upload->getError());  
        }
        // echo '<img src=' . __ROOT__.$fname . ' />';
        // dump($data);
       // $this->ajaxReturn($data);
    }
    public function sign(){
        $this->display();
    }

}