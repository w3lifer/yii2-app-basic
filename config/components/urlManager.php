<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [

        // Account controller

        'account' => 'account/index',

        // Main controller

        '<action:[A-Za-z0-9-]+>' => 'main/<action>',

    ],
];
