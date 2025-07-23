<?php

namespace App\Services;

class RandomElementCreatorService
{
    public static function randomStringFrom(string $character, int $length, int $min, int $max): string
    {
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand($min, $max);
            $string .= $character[$index];
        }

        return $string;
    }

}
