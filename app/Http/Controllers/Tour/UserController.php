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
        $dataUserFailedWithArrayType = json_decode($dataUserFailed['payload'], true);
//        dd($dataUserFailedWithArrayType);
        $response = $this->userRepository->createUser($dataUserFailedWithArrayType);
        if ($response->status() === 200) {
            $dataUserFailed->delete();
        }

        return response()->json($response);
    }

}
