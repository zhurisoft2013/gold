<?php
/**
* 文章模型
*/
namespace Common\Model;
use Think\Model\RelationModel;
class ArticleRelationModel extends RelationModel{
	protected $tableName="Article";
	protected $_link=array(
		'Category'=>array(
			'mapping_type'=>self::BELONGS_TO,
			'foreign_key'=>'category_id',
			'mapping_fields'=>'id,title',
			'as_fields'=>'id:category_id,title:category',
			),
		);

}
?>