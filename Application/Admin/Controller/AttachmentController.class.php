<?php 
/**
* 附件类
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
  `uploadip` char(15) NOT NOTULL DEFAULT '',
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
namespace Admin\Controller;
use Think\Controller;
class AttachmentController extends Controller{

	public function index(){
		$count=D('Attachment')->count();
		$Page=new \Think\Page($count,10);
		$this->pageinfo=$Page->show();

		$list=D('AttachmentRelation')->relation(true)->limit($Page->firstRow.','.$Page->listRows)->order('createtime desc')->select();
		$this->list=$list;
		// p($list);
		$this->display();
	}

	public function detail($id=0){
		if ($id==0) {
			$this->error('请提供需要查看的附件id');
		}
		$list=M('Attachment')->find($id);
		$this->attach=$list;
		$this->display();

	}

	public function delete($aid=0){
		if ($aid==0) {
			$this->error('删除文件id不存在');
		}
		if($model=M('Attachment')){
			$list=$model->find($aid);
			$fname=$list['fullfilename'];
			// echo $fname;
			$fname='.'.$fname;
			@unlink($fname);
			$model->delete($aid);
			$this->success('删除成功！');
		}
	}


}
 ?>