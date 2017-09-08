<?php
require_once( dirname(dirname(__DIR__)).'/console/controllers/sms2.php'); // 中華電信簡訊系統
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
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
    ],
];
