<?php

namespace App\Repositories\Tour;

use Illuminate\Support\Facades\DB;

class FailedUserRepository{

    public static function createFailedUser(array $data): void
    {
        DB::table('failed_users')->insert($data);
    }

}
