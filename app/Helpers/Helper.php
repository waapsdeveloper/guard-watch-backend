<?php

namespace App\Helpers;

class Helper
{

    static public function generateFourDigitCode()
    {
        return [
            'bool' => true,
            'result' => $data,
            'message' => $msg,
        ];
    }

    static public function error($msg, $data = [])
    {
        return [
            'bool' => false,
            'message' => $msg,
            'result' => $data
        ];
    }

    public static function generateRandomCode($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomCode = '';

        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomCode;
    }





}


