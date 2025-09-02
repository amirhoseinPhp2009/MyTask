<?php

declare(strict_types=1);

namespace App\Http\Controllers\Project;

use App\DTO\UserDTO;
use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\UserRequest;
use App\Models\Note;
use App\Repositories\FailedUserRepository;
use App\Repositories\Project\UserRepository;
use Illuminate\Http\JsonResponse;


class UsersController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(UserRequest $request): JsonResponse
    {
        $noteDB = Note::where(['id' => 5])->get();

        $noteCache = Note::where(['id' => 5])->get();

        $noteCache->isFromCache() === false;

        $noteCache->retry() === false;

        Note::force()->where(['id' => 5])->get();



        $requestData = UserDTO::fromRequest($request);

        try {
            $this->userRepository->createUser((array)$requestData);

            return response()->json(__('message.users.created'), StatusCode::OK->value);
        } catch (\Exception $exception) {

            $e = $exception->getMessage();

            (new FailedUsersController())->store((array)$requestData, $e);

            return response()->json(__('message.users.error'), StatusCode::INTERNAL_SERVER_ERROR->value);
        }
    }

    public function retry(string $uuid): JsonResponse
    {
        $failedUser = (array)FailedUserRepository::findFailedUserUuid($uuid);

        $userData = json_decode($failedUser['failed_data'], true);

        $userRequestClassData = new UserRequest($userData);

        return $this->store($userRequestClassData);
    }
}
