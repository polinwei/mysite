<?php
require_once( dirname(dirname(__DIR__)).'/console/controllers/sms2.php'); // 中華電信簡訊系統
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'modules' => [
		'redactor' => [
			'class' => 'yii\redactor\RedactorModule',
			'uploadDir' => '../../frontend/web/uploads',
			'uploadUrl' => 'http://im.globeunion.com/uploads',
			'imageAllowExtensions'=>['jpg','png','gif']
		],
	],
	'language'=> 'zh-TW',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
   		'authManager' => [
			'class' => 'yii\rbac\DbManager',
// 			'itemTable' => 'auth_item',
// 			'assignmentTable' => 'auth_assignment',
// 			'itemChildTable' => 'auth_item_child',
   		],
    	'i18n' => [
    		'translations' => [
    				'*' => [
    						'class' => 'yii\i18n\PhpMessageSource',    						
    						'basePath' => '@common/messages',
    						'fileMap' => [
    								'common' => 'common.php',
    								'test' => 'test.php'
    						],
    				],
    		],
    	],

    ],
];
