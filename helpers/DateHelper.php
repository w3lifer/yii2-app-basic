<?php

namespace app\helpers;

class DateHelper
{
    /**
     * @param int $dayOfWeek
     * @return int
     */
    public static function getNormalizedDayOfWeek($dayOfWeek)
    {
        return $dayOfWeek === 7 ? 0 : $dayOfWeek;
    }
}
