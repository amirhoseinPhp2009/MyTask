<?php

namespace App\Http\Controllers\QuestionCard;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCard\QuestionCardRequest;
use App\Repositories\QuestionCard\QuestionCardRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionCardsController extends Controller
{
    protected QuestionCardRepository $questionCardRepository;

    public function __construct(QuestionCardRepository $repository)
    {
        $this->questionCardRepository = $repository;
    }

    public function getQuestionCard($id): JsonResponse
    {
        // why variable name is user??
        $user = $this->questionCardRepository->getOneById($id);

        // if id not exists  return response with status code 404

        // why don't use resource class
        // data => ???
        return response()->json(['data' => $user]);
    }

    public function createQuestionCard(QuestionCardRequest $request): JsonResponse
    {
        $data = $request->validated();
        // don't use short variable name
        $res = $this->questionCardRepository->create($data);

        if ($res) {
            return response()->json(['message' => __('message.question_cards.created')], StatusCode::OK->value);
        }
        return response()->json(['message' => __('message.question_cards.cant_crate')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }

    public function updateQuestionCard($id, Request $request): JsonResponse
    {
        // define request class in all method
        $request['updated_at'] = '2025-09-11';

        // don't use toArray function in request class
        $data = $request->toArray();

        // don't check permission for update flash card
        $res = $this->questionCardRepository->update($id, $data);

        if ($res) {
            return response()->json(['message' => __('message.question_cards.updated')], StatusCode::OK->value);
        }

        return response()->json(['message' => __('message.question_cards.cant_updated')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }

    public function deleteQuestionCard($id): JsonResponse
    {
        $res = $this->questionCardRepository->delete($id);

        if ($res) {
            return response()->json(['message' => __('message.question_cards.deleted')], StatusCode::OK->value);
        }
        return response()->json(['message' => __('message.question_cards.cant_deleted')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }
}
