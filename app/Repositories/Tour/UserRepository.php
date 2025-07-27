<?php

namespace App\Repositories\Tour;

use App\DTO\FailedUserDTO;
use App\Enums\StatusCode;
use App\Models\FailedUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class UserRepository
{
    /**
     * @param string $uuId
     * @return FailedUser
     */
    public static function findUserFailedByUuId(string $uuId): FailedUser
    {
        return FailedUser::where('uuid', $uuId)->first();
    }


    public static function createUser($data): JsonResponse
    {
        try {
            DB::table('users')->insert($data);
            
            return response()->json(__('message.userCreated'), StatusCode::OK->value);
        } catch (\Exception $exception) {

            $dataFailedUser = FailedUserDTO::getDataFailedUser($data, $exception->getMessage());
            FailedUserRepository::createFailedUser($dataFailedUser);

            return response()->json(__('message.userCreatedFailed'), StatusCode::INTERNAL_SERVER_ERROR->value);
        }
    }
}

