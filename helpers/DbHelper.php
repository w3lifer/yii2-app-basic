<?php

namespace app\helpers;

class DbHelper
{
    /**
     * @param string $name
     * @param string $dsn
     * @return string
     * @see https://github.com/yiisoft/yii2/issues/6533#issuecomment-67379715
     */
    public static function getDsnAttribute($name, $dsn)
    {
        if (preg_match('=' . $name . '\=([^;]*)=', $dsn, $matches)) {
            return $matches[1];
        }
        return '';
    }
}
