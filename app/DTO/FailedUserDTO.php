<?php

namespace App\DTO;

use App\Models\FailedUser;
use App\Services\RandomElementCreatorService;
use App\Services\UuidUniqueFailedUsersTableService;
use Carbon\Carbon;

class FailedUserDTO
{
    public static function getDataFailedUser(array $payload, string $exception): array
    {
        $timeNow = Carbon::now()->format('Y-m-d H:i:s');
        $lastRecord = FailedUser::orderBy('id', 'desc')->first()->id + 1;
        $stringPayload = json_encode($payload);
        $charachter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $min = 5; $max = 10; $length = 7;
        $uuid = RandomElementCreatorService::randomStringFrom($charachter, $length, $min, $max);

        return [
            'id' => $lastRecord,
            'uuid' => $uuid,
            'payload' => $stringPayload,
            'exception' => $exception,
            'failed_at' => $timeNow,
        ];
    }
}
