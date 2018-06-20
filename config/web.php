<?php

use yii\helpers\Inflector;

$params = require_once __DIR__ . '/params.php';

$config = [

    // Required properties

    'id' => 'basic',
    'basePath' => dirname(__DIR__),

    // Optional properties (sorted alphabetically)

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['log'],
    'components' => [ // Sorted alphabetically
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/' .
                            (YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'),
                    ],
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => require_once __DIR__ . '/db.php',
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/translations',
                ],
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'request' => [
            'cookieValidationKey' => '',
        ],
        // https://github.com/codemix/yii2-localeurls#yii2-locale-urls
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            // 'enableLocaleUrls' => false,
            'languages' => ['en', 'ru'],
            'showScriptName' => false,
            'enableLanguageDetection' => false,
            'rules' => [
                // Account controller
                'account' => 'account/index',
                // Main controller
                '<action:[A-Za-z0-9-]+>' => 'main/<action>',

            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['account/login'],
        ],
    ],
    'defaultRoute' => 'main',
    'name' => 'My Yii2 App Basic',
    'params' => $params,

    // Events

    'on beforeAction' => function () {

        // ROUTE constant

        define('ROUTE', Yii::$app->controller->route);

        // ROUTE_AS_ID constant

        $explodedRoute = explode('/', ROUTE);
        $controllerId = $explodedRoute[0];
        $actionId = $explodedRoute[1];
        define(
            'ROUTE_AS_ID',
                'C-' . Inflector::camelize($controllerId) .
                    '-' .
                        'A-' . Inflector::camelize($actionId)
        );

    },

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
