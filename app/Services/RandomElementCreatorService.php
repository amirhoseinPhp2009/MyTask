<?php

namespace App\Services;

class RandomElementCreatorService
{
    public static function randomStringFrom($character): string
    {
        $pin = mt_rand(10,20)
            . $character[rand(0, strlen($character) - 1)];

        return str_shuffle($pin);
    }
}
