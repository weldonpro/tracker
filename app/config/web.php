<?php
use yii\base\Application;

$config = [
    'name'=>'Tracker',
	'id' => 'bootstrap',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'=>'ru',
    'defaultRoute'=>'dashboard/default/index',
    'modules' => [
        'dashboard' => [
            'class' => 'app\modules\dashboard\Module',
        ],
    ],
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
	'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tracker_db',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
		'request' => [
			'enableCsrfValidation' => true,
		],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
		'user' => [
			'identityClass' => 'app\models\User',
            'enableAutoLogin' => true
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
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
        'urlManager' => [
            'class' => '\yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
	],
    'on beforeRequest'=>['app\components\events\BeforeRequestHandler', 'handle'],
	'params' => require(__DIR__ . '/params.php'),
];

if (YII_ENV == 'local') {
	$config['preload'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';
	$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
