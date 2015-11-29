<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'不学则退',
	'defaultController'=>'index',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),


		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'dir'=>dirname(__FILE__),
		'app'	=>array(
			'MobileApiKey'=>'1234567',
			'MobileApiValidtime'=>10*60,
		),
		'chuanglan'=>array(
			'api_send_url'=>'http://222.73.117.158/msg/HttpBatchSendSM',//创蓝发送短信接口URL, 如无必要，该参数可不用修改
			'api_balance_query_url'=>'http://222.73.117.158/msg/QueryBalance',//创蓝短信余额查询接口URL, 如无必要，该参数可不用修改
			'api_account'=>'xxxx',//创蓝账号 替换成你自己的账号
			'api_password'=>'xxxx',//创蓝密码，以数字和字母组成的32位字符
		),
		'cards' =>array(
			0=>array('key'=>0,'name'=>'体验通卡'),
			1=>array('key'=>1,'name'=>'通卡'),
		),
		'banklist' => array(
			'CMB' => '招商银行',
			'ICBC' => '中国工商银行',//ICBC-D
			'CCB' => '中国建设银行',
			'BOC' => '中国银行',
			'ABC' => '中国农业银行',//ABC-D
			'HSBC' => '交通银行',
			'SPDB' => '浦发银行',
			'GDB'=>'广东发展银行',
			'CITIC' => '中信银行',//CITIC-D
			'CEB' => '中国光大银行',
			'CIB'=>'兴业银行',
			'CMBC' => '中国民生银行',
			'HXB' => '华夏银行',
			'SDB' => '平安银行',
			'PSBC' => '中国邮政储蓄银行',
			'HZBANK' => '杭州银行',
		),
	),
);
