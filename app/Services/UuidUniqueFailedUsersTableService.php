<?php

namespace App\Services;

use Carbon\Carbon;

class UuidUniqueFailedUsersTableService {

    public static function createUuId(array $payloadUserFailed): string
    {

        $payloadText = RandomElementCreatorService::randomStringFrom('ABCDEFGHIJKLMNOPQRSTUVWXYZ', 7, 5, 10);
        $time = Carbon::now()->format('YmdHis');

        return $payloadText . $time;
    }

}
