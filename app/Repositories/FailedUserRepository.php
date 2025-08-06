<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use stdClass;

class FailedUserRepository
{
    public static function createFailedUser(array $data): bool
    {
        return DB::table('failed_users')->insert($data);
    }

    public static function findFailedUserUuid(string $uuid): StdClass
    {
        return DB::table('failed_users')->where('uuid', $uuid)->first();
    }
}
