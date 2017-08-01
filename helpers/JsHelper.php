<?php

namespace app\helpers;

use Yii;

/**
 * Js helper.
 */
class JsHelper
{
    const PATH_PREFIX = 'js/';

    /**
     * @param string $route
     * @return string
     */
    public static function getPathToJsFileByRoute($route)
    {
        $pathToJsFile = self::PATH_PREFIX . $route . '.js';
        if (Yii::$app->assetManager->appendTimestamp) {
            $modificationTime =
                filemtime(
                    Yii::getAlias('@webroot') . '/' . $pathToJsFile
                );
            $pathToJsFile .= '?v=' . $modificationTime;
        }
        return $pathToJsFile;
    }
}
