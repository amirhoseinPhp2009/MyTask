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
        $userData = UserDTO::getDataUser($request);
        $response = $this->userRepository->createUser($userData);

        return response()->json($response);
    }

    public function retryCreateUser(string $uuidUserFailed): JsonResponse
    {
        $dataUserFailed = $this->userRepository->findUserFailedByUuId($uuidUserFailed);
        $response = $this->userRepository->createUser($dataUserFailed['payload']);

        return response()->json($response);
    }

}
