<?php

namespace App\Http\Controllers\Project;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Repositories\FailedUserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class FailedUsersController extends Controller
{

    public function store(array $requestData, string $errorMessage): JsonResponse
    {
        $jsonData = json_encode($requestData);
        $uuid = Str::uuid()->toString();

        $data = [
            "uuid" => $uuid,
            "error_message" => $errorMessage,
            "failed_data" => $jsonData,
        ];

        $response = FailedUserRepository::createFailedUser($data);

        return response()->json(['error' => __('message.users.error')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }
}
