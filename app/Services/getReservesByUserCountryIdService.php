<?php

namespace App\Services;

use App\Models\Reserve;

class getReservesByUserCountryIdService
{
    public static function getReservesByUserCountryId(int $userCountryId): array
    {
        $allReserves = Reserve::all()->sortBy('check_in');
        $reserves = [];

        foreach ($allReserves as $reserve) {
            if ($reserve->user->country_id === $userCountryId) {
                $reserves[] = $reserve;
            }
        }

        return $reserves;
    }

}
