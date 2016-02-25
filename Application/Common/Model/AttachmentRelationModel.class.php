<?php 
/**
* 附件模型类
*/
/*附件上传表
CREATE TABLE IF NOT EXISTS `my_attachment` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL DEFAULT '',
  `action` varchar(20) NOT NULL DEFAULT '',
  `filename` varchar(50) NOT NULL DEFAULT '',
  `filepath` varchar(80) NOT NULL DEFAULT '',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `fileext` char(10) NOT NULL DEFAULT '',
  `isimage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `userid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `uploadip` char(15) NOT NULL DEFAULT '',
  `cite` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ori_filename` varchar(50) NOT NULL COMMENT '原文件名',
  `fullfilename` varchar(160) NOT NULL DEFAULT '' COMMENT '包括路径的文件全名',
  `hash` char(32) NOT NULL DEFAULT '' COMMENT 'hash值',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;
 */
/*附件使用表
CREATE TABLE IF NOT EXISTS `my_attachment_usage` (
  `uid` int(11) NOT NULL COMMENT '文章id',
  `aid` int(11) NOT NULL COMMENT '附件id',
  `filename` varchar(128) NOT NULL COMMENT '附件地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 */
namespace Common\Model;
use Think\Model\RelationModel;
class AttachmentRelationModel extends RelationModel {
      protected $tableName='Attachment';
      protected $_link=array(
        'Article'=>array(
              'mapping_type'=>self::MANY_TO_MANY,
              'foreign_key'=>'attachment_id',
              'relation_foreign_key'=>'article_id',
              'relation_table'=>'my_article_attachment',
              // 'mapping_fields'=>'id,title'
              ),
        

        );
	/**
	 * 根据添加的内容利用正则匹配出上传的附件，然后将附件信息添加的附件使用表中
	 * @param [type] $blog_id [添加的图书的id]
	 * @param [type] $content [添加的内容]
	 */
	public function add($article_id ,$content) {
            $files=$this->getUploadFilelist($content);
            // dump($files);
    		$usage=M('Article_attachment');
    		foreach ($files as $key => $value) {
    			$condition=array(
    				'fullfilename' => $value,
    				);
    			$list=$this->field('id,fullfilename')->where($condition)->find();
                  // dump($list);
                  // dump($condition);
    			$this->where(array('id'=>$list['id']))->setInc('cite');
    			$data=array(
    				'article_id' => $article_id,
    				'attachment_id' => $list['id'],
    				);
                 
    			if(!$usage->where($data)->find()){
    				$data['fullfilename'] = $list['fullfilename'];
                        $result=$usage->add($data);

    			}
    		}
	}
/**
 * 当修改了博文内容的时候，去更新附件的引用情况
 * 基本思路,去比较博文内容的中附件内容和已经放在数据库中的附件内容进行比较，如果有新的则新增，如果附件不存在则删除
 * @param  [type] $blog_id 博文id
 * @param  [type] $content 博文内容
 * @return [type]          [description]
 */
      public function update($article_id, $content){
          //获得内容中的上传文件路径名
          $files=$this->getUploadFilelist($content);
          // echo 'files';dump($files);
          // exit;
          $usage=M('Article_attachment'); 
          if (empty($files)) {
            $list=array();
            $content_aid=array();
          }else{
              $condition=array();
              $condition['fullfilename']=array('in',$files);
              $list=$this->where($condition)->getField('id,fullfilename');
              //获得内容中上传附件的附件id
              if(empty($list)){$list=array();}
              // echo 'list';var_dump($list);
              $content_aid=array_keys($list);
               // if(empty($content_aid)){$content_aid=array();}
              // echo 'content_aid';var_dump($content_aid); 

          }
 
          $aid=$usage->where(array('article_id'=>$article_id))->getField('attachment_id',true);
          if(empty($aid)){$aid=array();}
          // echo 'aid';dump($aid);
          if(!empty($aid)){
            $del_aid=array_diff($aid, $content_aid);
            // echo 'del_aid';dump($del_aid);
            foreach ($del_aid as $key => $value) {
              $this->where(array('id'=>$value))->setDec('cite');
              $data=array(
                'article_id'=>$article_id,
                'attachment_id'=>$value,
              );
              $usage->where($data)->delete();
            }            
          }

          if (!empty($content_aid)){
              $new_aid=array_diff($content_aid, $aid);
              // echo 'new_aid';dump($new_aid);

              foreach ($new_aid as $key => $value) {
                $this->where(array('id'=>$value))->setInc('cite');
                $data=array(
                  'article_id'=>$article_id,
                  'attachment_id'=>$value,
                  'fullfilename'=>$list[$value],
                  );
                $usage->add($data);
              }
          
          }

      }

      public function delete($article_id, $content){
           //获得内容中的上传文件路径名
          $files=$this->getUploadFilelist($content);     
          $usage=M('Article_attachment');
          foreach ($files as $key => $value) {
            $condition=array(
              'fullfilename' => $value,
              );
            $attachment_id=$this->field('id,fullfilename')->where($condition)->getField('id');

            $this->where(array('id'=>$attachment_id))->setDec('cite');
            $data=array(
              'article_id' => $article_id,
              'attachment_id' =>  $attachment_id,
              );
            $usage->where($data)->delete();                  

          }

            
      }

		/**
	 * [delattach 删除附件]
	 * @param  string $map [删除条件]
	 * @return [type]      [description]
	 */
	 private function delattach($map=''){
		$model = M('Attachment');
		$att= $model->field('id,fullfilename')->where($map)->select();
		$aids=array();
		foreach((array)$att as $key=> $r){
			$aids[]=$r['id'];
			@unlink(__ROOT__.$r['filepath']);
		}
		$r =$model->delete(implode(',',$aids));
		return  false!==$r ? true : false;
	}
  /**
   * [getUploadFilelist 获得内容中的上传文件列表]
   * @param  [type] $content [description]
   * @return [type]          [description]
   */
      private function getUploadFilelist($content){
        // $web_root=addcslashes(__ROOT__ .'/','/');
        $uploadPath=C('UPLOAD_ROOT_PATH').C('UPLOAD_SAVE_PATH');
        $uploadPath=substr($uploadPath,1);
        $web_root=addcslashes(__ROOT__ . $uploadPath ,'/');
        $files=array();
        $preg='/<img[\s\S]*?src=\"' .  $web_root . '(.+?)\".*?>/i';
        preg_match_all($preg, $content, $matches);
        $files=array_merge($files,$matches[1]);
        $preg='/<a[\s\S]*?href=\"' . $web_root . '(.+?)\".*?>/i';
        /*$preg='/<a[\s\S]*?href=\"\/blog2\/Public\/uploads\/(.+?)\".*?>/i';*/
        preg_match_all($preg, $content, $matches);
        $files=array_merge($files,$matches[1]);
        foreach ($files as $key => $value) {
          $files[$key]=strtolower($uploadPath . $value);
        }
        return $files;
      }

}
 ?>