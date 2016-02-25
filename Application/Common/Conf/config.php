<?php
return array(
	//'配置项'=>'配置值'
	'URL_CASE_INSENSITIVE'=>true,
	'TMPL_VAR_PARSE'=>'array',
	// 'SHOW_PAGE_TRACE'=>true,

	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'127.0.0.1',
	'DB_USER'=>'root',
	'DB_PWD'=>'',
	'DB_NAME'=>'gold',

	'DB_PORT'=>3306,
	'DB_PREFIX'=>'my_',

	'VAR_SESSION_ID'=>'PHPSESSID',

	'LOAD_EXT_CONFIG'=>'upload',
	//默认错误跳转对应的模板文件
	'TMPL_ACTION_ERROR' => './Public/tpl/dispatch_jump_mobile.html',
	//默认成功跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' =>  './Public/tpl/dispatch_jump_mobile.html',

	 'UPLOAD_ROOT_PATH' => './Public/uploads/',


);