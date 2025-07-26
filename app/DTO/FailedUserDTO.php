<?php

namespace App\DTO;

use App\Services\UuidUniqueFailedUsersTableService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FailedUserDTO{
    public static function getDataFailedUser(array $payload, string $exception): array
    {
        $uuid = UuidUniqueFailedUsersTableService::createUuId($payload);
        $timeNow = Carbon::now()->format('Y-m-d H:i:s');
        $stringPayload = implode(",", $payload);

        return [
            'id' => DB::table('failed_users')->get()->last()->id+1,
            'uuid' => $uuid,
            'payload' => $stringPayload,
            'exception' => $exception,
            'failed_at' => $timeNow,
        ];
    }

}
