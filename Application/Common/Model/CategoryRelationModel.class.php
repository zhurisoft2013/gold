<?php
/**
* 分类关联模型
*/
namespace Common\Model;
use Think\Model\RelationModel;
class CategoryRelationModel extends RelationModel{
	protected $tableName="Category";
	protected $_link=array(
		'Article'=>array(
			'mapping_type'=>self::HAS_MANY,
			'foreign_key'=>'category_id',
			'mapping_fields'=>'id,title',
			'mapping_order'=>'sort asc,id desc',
			'mapping_limit'=>5,
			),
		);
}
?>