<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'defaultRoute' => 'book/index',
	'timeZone'=>'Asia/Chongqing',
    'components' => [
	
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'icysnow',
        ],
			'urlManager' => [             
		'enablePrettyUrl' => true,
		'showScriptName' => false, 
		'rules' => [              
		],                        
	],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'user' => [
            // 'identityClass' => 'app\models\User',
            // 'enableAutoLogin' => true,
        // ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
       'mailer' => [
		'class' => 'yii\swiftmailer\Mailer',
		'viewPath' => '@app/mailer',
		'useFileTransport' => false,
		'transport' => [
		  'class' => 'Swift_SmtpTransport',
		  'host' => 'smtp.163.com',
		  'username' => 'icysnow123@163.com',
		  'password' => 'aaa123',
		  'port' => '25',
		  'encryption' => 'tls',
		  ],
		  
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
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
	'modules' => [
		'user' => [
		  'class' => 'dektrium\user\Module',
		  'confirmWithin' => 21600,
		  'cost' => 12,
		  'admins' => ['admin']
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
