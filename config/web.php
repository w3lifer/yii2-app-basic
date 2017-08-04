<?php

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [ // Sorted alphabetically
        'assetManager' => require_once __DIR__ . '/components/assetManager.php',
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => require_once __DIR__ . '/components/db.php',
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
        'i18n' => require_once __DIR__ . '/components/i18n.php',
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'request' => [
            'cookieValidationKey' => '',
        ],
        'urlManager' => require_once __DIR__ . '/components/urlManager.php',
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['account/login'],
        ],
    ],
    'defaultRoute' => 'main',
    'name' => 'Yii2 App Basic Plus',
    'params' => require_once __DIR__ . '/params.php',

    // Events

    'on beforeAction' => require_once __DIR__ . '/beforeAction.php',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
