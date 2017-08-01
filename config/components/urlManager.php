<?php

/**
 * @see https://github.com/codemix/yii2-localeurls#yii2-locale-urls
 */

return [
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
];
