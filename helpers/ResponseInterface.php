<?php

namespace app\helpers;

class ResponseInterface
{
    /**
     * @param array $errors
     * @return array
     */
    public static function getFalseResponse($errors = [])
    {
        return [
            'success' => false,
            'errors' => $errors,
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public static function getTrueResponse($data = [])
    {
        return [
            'success' => true,
            'data' => $data,
        ];
    }
}
