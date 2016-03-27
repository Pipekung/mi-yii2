<?php

$params = require __DIR__ . '/params.php';

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'language' => 'th',
	'as access' => [
		'class' => 'mdm\admin\components\AccessControl',
		'allowActions' => [
			// '*',
			'user/security/login',
			'user/security/logout',
			// 'site/index',
			// 'site/about',
			'site/*',
		],
	],
	'modules' => [
		'user' => [
			'class' => 'dektrium\user\Module',
			'modelMap' => [
				'Profile' => 'app\models\Profile',
			],
			'admins' => ['admin'],
		],
		'admin' => [
			'class' => 'mdm\admin\Module',
			'layout' => 'left-menu',
			'mainLayout' => '@app/themes/agency/views/layouts/main.php',
			'menus' => [
				// 'assignment' => [
				// 	'label' => 'Grand Access', // change label
				// ],
				// 'route' => null, // disable menu
				'user' => null,
				'role' => null,
				'rule' => null,
				'menu' => null,
			],
			'controllerMap' => [
				'assignment' => [
					'class' => 'mdm\admin\controllers\AssignmentController',
					/* 'userClassName' => 'app\models\User', */
					// 'userClassName' => 'dektrium\user\models\User',
					'idField' => 'user_id',
					'usernameField' => 'username',
					'fullnameField' => 'profile.fullname',
					'extraColumns' => [
						[
							// 'attribute' => 'full_name',
							'label' => 'Full Name',
							'value' => function ($model, $key, $index, $column) {
								return empty($model->profile->fullname) ? '' : $model->profile->fullname;
							},
						],
						[
							// 'attribute' => 'dept_name',
							'label' => 'Department',
							'value' => function ($model, $key, $index, $column) {
								return empty($model->profile->department->name) ? '' : $model->profile->department->name;
							},
						],
					],
					// 'searchClass' => 'dektrium\user\models\UserSearch',
				],
			],
		],
	],
	'components' => [
		'userRole' => [
			'class' => 'app\components\UserRole',
		],
		'view' => [
			'theme' => [
				'basePath' => '@app/themes/agency',
				'baseUrl' => '@web/themes/agency',
			],
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'mP-q14oFd0l6YQOL8z-oux5ZjC5LR8FK',
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'dektrium\user\models\User',
			'enableAutoLogin' => true,
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' => require __DIR__ . '/db.php',
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
			],
		],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
}

return $config;
