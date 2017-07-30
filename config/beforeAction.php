<?php

use yii\helpers\Inflector;

return function () {

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

};
