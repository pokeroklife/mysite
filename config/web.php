<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$db2 = require __DIR__ . '/db2.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),

    'language' => 'en-US',

    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@image' => 'W:/domains/mysite/web/img',
        '@smallImage' => 'W:/domains/mysite/web/img/small',

    ],
    'layout' => 'main',
    'modules' => [
        'admin' => [
            'class' => \app\modules\admin\Admin::class,
        ],
        'blog' => [
            'class' => \app\modules\blog\Blog::class,
        ],
        'shop' => [
            'class' => \app\modules\shop\Shop::class,
        ],
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@web\messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
//                        'main' => '/main.php',
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'a5FYmgcw-q6_gyfMYAq1hC0tllQpx2ZR',
            'class' => \app\components\LangRequest::class,
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
        ],
        'user' => [
            'identityClass' => \app\models\User::class,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\swiftmailer\Mailer::class,
            // send all mails to a file by news. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'db2' => $db2,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => \app\components\LangUrlManager::class,
            'rules' => [
                '/' => 'site/index',
                '<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
            ]
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
