<?php

namespace App\Repositories\Tour;

use App\Models\FailedUser;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder;

class FailedUserRepository{

    public static function createFailedUser(array $data): bool
    {
        return DB::table('failed_users')->insert($data);
    }

}
