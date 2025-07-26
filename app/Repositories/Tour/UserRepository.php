<?php

namespace App\Repositories\Tour;

use App\DTO\FailedUserDTO;
use App\Enums\StatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class UserRepository
{
    /**
     * @param string $uuId
     * @return stdClass
     */
    public static function findUserFailedByUuId(string $uuId): stdClass
    {
        dd(
            DB::table('failed_users')->where('uuid', $uuId)->get()->first()
            );
//        return
    }


    public static function createUser($data): JsonResponse
    {
        try {
            DB::table('users')->insert($data);

            return response()->json(__('message.userCreated'), StatusCode::OK->value);
        } catch (\Exception $exception) {
            $dataFailedUser = FailedUserDTO::getDataFailedUser($data, $exception->getMessage());
            FailedUserRepository::createFailedUser($dataFailedUser);

            return response()->json($exception, StatusCode::INTERNAL_SERVER_ERROR->value);
        }
    }
}

