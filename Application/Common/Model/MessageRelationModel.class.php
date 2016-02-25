<?php
/**
* 留言关联模型
*/
namespace Common\Model;
use Think\Model\RelationModel;
class MessageRelationModel extends RelationModel{
	protected $tableName='Message';
	protected $_link=array(
/*		'Message'=>array(
			'mapping_type'=>self::BELONGS_TO,
			'parent_key'=>'pid',
			'foreign_key'=>'id',

			),*/
		'Parent' => array(
			'mapping_type' => self::BELONGS_TO,
			'class_name' => 'Message',
			'mapping_name' => 'Parent',
			'parent_key' => 'pid',
			),
		);	
}
?>