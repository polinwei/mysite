<?php
require_once( dirname(dirname(__DIR__)).'/console/controllers/sms2.php'); // 中華電信簡訊系統
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'modules' => [
		'redactor' => [
			'class' => 'yii\redactor\RedactorModule',
			'uploadDir' => '../../frontend/web/uploads',
			'uploadUrl' => 'http://im.globeunion.com/uploads',
			'imageAllowExtensions'=>['jpg','png','gif'],
			'widgetClientOptions' => [
				'imageManagerJson' => ['/redactor/upload/image-json'],
				'imageUpload' => ['/redactor/upload/image'],
				'fileUpload' => ['/redactor/upload/file'],
				'lang' => 'zh_tw',
				'plugins' => ['clips', 'fontcolor','imagemanager','filemanager']
			] 
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
	'controllerMap' => [
		'elfinder' => [
			'class' => 'mihaildev\elfinder\Controller',
			'access' => ['@'], //Global file manager access @ - for authorized , ? - for guests , to open to all ['@', '?']
			'disabledCommands' => ['netmount'], //disabling unnecessary commands https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
			'roots' => [
							[
							'baseUrl'=>'http://im.globeunion.com',
							'basePath'=>'@frontend/web',
							'path' => 'files/global',
							'name' => 'Global'
							],
							[
							'class' => 'mihaildev\elfinder\volume\UserPath',
							'path'  => 'files/user_{id}',
							'name'  => 'My Documents'
							],
							[
							'path' => 'files/some',
							'name' => ['category' => 'my','message' => 'Some Name'] //перевод Yii::t($category, $message)
							],
							[
							'path'   => 'files/some',
							'name'   => ['category' => 'my','message' => 'Some Name'], // Yii::t($category, $message)
							'access' => ['read' => '*', 'write' => 'UserFilesAccess'] // * - for all, otherwise the access check in this example can be seen by all users with rights only UserFilesAccess
							]
						],
			'watermark' => [
							'source'         => __DIR__.'/logo.png', // Path to Water mark image
							'marginRight'    => 5,          // Margin right pixel
							'marginBottom'   => 5,          // Margin bottom pixel
							'quality'        => 95,         // JPEG image save quality
							'transparency'   => 70,         // Water mark image transparency ( other than PNG )
							'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
							'targetMinPixel' => 200         // Target image minimum pixel size
						]
			]
		],
];
