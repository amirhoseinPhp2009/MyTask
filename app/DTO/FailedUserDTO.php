<?php

namespace App\DTO;

use App\Models\FailedUser;
use App\Models\User;
use App\Services\UuidUniqueFailedUsersTableService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FailedUserDTO{
    public static function getDataFailedUser(array $payload, string $exception): array
    {
        $uuid = UuidUniqueFailedUsersTableService::createUuId($payload);
        $timeNow = Carbon::now()->format('Y-m-d H:i:s');
        $lastRecord = FailedUser::orderBy('id', 'desc')->first()->id+1;
//        $outputString = '';

        $stringPayload = json_encode($payload);

//        foreach ($payload as $key => $value) {
//            $outputString .= "$key => '$value',";
//        }

//        $outputString = rtrim($outputString, ',');

        return [
            'id' => $lastRecord,
            'uuid' => $uuid,
            'payload' => $stringPayload,
            'exception' => $exception,
            'failed_at' => $timeNow,
        ];


    }

}
