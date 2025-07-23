<?php

namespace App\Services;

use Carbon\Carbon;
class TrackingCodeBuilderService
{
    public static function generateTrackingCode(): string
    {
        $userId = 1;
        $character = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789*&%#";
        $length = 7;
        $min = 0;
        $max = 7;
        $time = Carbon::now()->format('Y-m-d H:i:s u');
        $number = str_replace(['-', ' ', ':'], '', $time);

        $randomCharacter = RandomElementCreatorService::randomStringFrom($character, $length, $min, $max);

        return $userId . $randomCharacter . $number;
    }
}
