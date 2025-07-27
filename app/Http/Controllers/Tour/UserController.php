<?php

namespace App\Http\Controllers\Tour;

use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\UserRequest;
use App\Repositories\Tour\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(UserRequest $request): JsonResponse
    {
        $requestData = UserDTO::getDataUser($request);
        $response = $this->userRepository->createUser($requestData);

        return response()->json($response);
    }

    public function retryCreateUser(string $uuid): JsonResponse
    {
        $recordFailed = $this->userRepository->findUserFailedByUuId($uuid);
        $paramsRecordFailed = json_decode($recordFailed['payload'], true);
        $response = $this->userRepository->createUser($paramsRecordFailed);

        return response()->json($response);
    }

}
