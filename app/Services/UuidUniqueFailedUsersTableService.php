<?php

namespace App\Services;

use Carbon\Carbon;

class UuidUniqueFailedUsersTableService {

    public static function createUuId(array $payloadUserFailed): string
    {
        $payloadText = $payloadUserFailed['phone'];
        $time = Carbon::now()->format('YmdHis');

        return $payloadText . $time;
    }

}
