<?php

namespace App\Repositories\Tour;

use App\Models\FailedUser;
use Illuminate\Support\Facades\DB;

class FailedUserRepository{

    public static function createFailedUser(array $data): bool
    {
        return FailedUser::create($data);
    }

}
