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
}
