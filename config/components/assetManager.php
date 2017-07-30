<?php

return [
    'appendTimestamp' => true,
    'bundles' => [
        'yii\web\JqueryAsset' => [
            'js' => [
                'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/' .
                    (YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'),
            ],
        ],
    ],
];
