<?php

namespace App\Repositories\Tour;

use App\DTO\FailedUserDTO;
use App\Enums\StatusCode;
use App\Models\FailedUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;

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


    public static function createUser(array $data): JsonResponse
    {
        try {
            User::create($data);

            return response()->json(__('message.userCreated'), StatusCode::OK->value);
        } catch (\Exception $exception) {
            $payload = FailedUserDTO::getDataFailedUser($data, $exception->getMessage());
            FailedUserRepository::createFailedUser($payload);

            return response()->json(__('message.userCreatedFailed'), StatusCode::INTERNAL_SERVER_ERROR->value);
        }
    }
}

