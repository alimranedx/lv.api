<?php

namespace App\Common\Utility;
class Exception
{
    public static function fullMessage(\Throwable $throwable):string
    {
       return $throwable->getMessage()." at line ".$throwable->getLine()." in ".$throwable->getFile();

    }
}
