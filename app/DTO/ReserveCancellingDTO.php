<?php

namespace App\DTO;

use App\Models\Reserve;
use Carbon\Carbon;

class ReserveCancellingDTO
{
    public static function createCancellingReserveData(Reserve $reserve): array
    {
        $time = Carbon::now();
        $userFullName = $reserve->user->first_name . ' ' . $reserve->user->last_name;
        $halfReservePrice = $reserve->sell_price / 2;

        return [
            'reserveData' => [
                'status' => 'cancelled_by_admin',
                'cancelled_at' => $time
            ],
            'messageDataToUser' => [
                'reserve_date' => $reserve->created_at,
                'full_name' => $userFullName,
                'date_now' => $time,
                'half_reserve_price' => $halfReservePrice,
            ]
        ];
    }
}
