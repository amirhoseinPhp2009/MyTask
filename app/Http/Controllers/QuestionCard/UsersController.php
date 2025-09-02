<?php

namespace App\Http\Controllers\QuestionCard;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCard\UserRequest;
use App\Repositories\QuestionCard\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected UserRepository $UserRepository;

    public function __construct(UserRepository $repository)
    {
        $this->UserRepository = $repository;
    }

    public function getUser(int $id): JsonResponse
    {
        $user = $this->UserRepository->getOneById($id);

        return response()->json(['data' => $user]);
    }

    public function createUser(UserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $res = $this->UserRepository->create($data);

        if ($res) {
            return response()->json(['message' => __('message.users.created')], StatusCode::OK->value);
        }
        return response()->json(['message' => __('message.users.cant_crate')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }

    public function updateUser(int $id, Request $request): JsonResponse
    {
        $data = $request->toArray();

        $res = $this->UserRepository->update($id, $data);

        //??
        if ($res) {
            return response()->json(['message' => __('message.users.updated')], StatusCode::OK->value);
        }
        //??
        return response()->json(['message' => __('message.users.cant_updated')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }

    public function deleteUser(int $id): JsonResponse
    {
        $res = $this->UserRepository->delete($id);

        if ($res) {
            return response()->json(['message' => __('message.users.deleted')], StatusCode::OK->value);
        }
        return response()->json(['message' => __('message.users.cant_deleted')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }
}
