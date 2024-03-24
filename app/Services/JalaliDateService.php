<?php

namespace App\Services;

class JalaliDateService
{
    public static function getDate()
    {
        return (verta()->format('Y/m/d'));
    }

    public static function getTime()
    {
        return verta()->format('H:i:s');
    }
}
