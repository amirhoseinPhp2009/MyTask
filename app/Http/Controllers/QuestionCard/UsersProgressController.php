<?php

namespace App\Http\Controllers\QuestionCard;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCard\SendAnswerQuestionCardsRequest;
use App\Http\Requests\QuestionCard\UserRequest;
use App\Repositories\QuestionCard\QuestionCardRepository;
use App\Repositories\QuestionCard\UserProgressLogRepository;
use App\Repositories\QuestionCard\UserProgressRepository;
use App\Services\buildNextReviewDateForUserProgressService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersProgressController extends Controller
{
    protected UserProgressRepository $userProgressRepository;
    protected QuestionCardRepository $questionCardRepository;
    protected UserProgressLogRepository $userProgressLogRepository;

    public function __construct(
        UserProgressRepository    $userProgressRepository,
        QuestionCardRepository    $questionCardRepository,
        UserProgressLogRepository $userProgressLogRepository)
    {
        $this->userProgressRepository = $userProgressRepository;
        $this->questionCardRepository = $questionCardRepository;
        $this->userProgressLogRepository = $userProgressLogRepository;
    }

    public function getUserProgress($id): JsonResponse
    {
        $user = $this->userProgressRepository->getOneById($id);

        return response()->json(['data' => $user]);
    }

    public function createUser(UserRequest $request): JsonResponse
    {
        // request class name is not valid
        // function name is not valid
        $data = $request->validated();
        $res = $this->userProgressRepository->create($data);

        if ($res) {
            return response()->json(['message' => __('message.user_progress.created')], StatusCode::OK->value);
        }

        return response()->json(['message' => __('message.user_progress.cant_crate')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }

    public function updateUser(int $id, Request $request): JsonResponse
    {
        // request class is not exist
        // function name is not valid
        // don't any login in class
        $data = $request->toArray();

        $res = $this->userProgressRepository->update($id, $data);

        if ($res) {
            return response()->json(['message' => __('message.user_progress.updated')], StatusCode::OK->value);
        }

        return response()->json(['message' => __('message.user_progress.cant_updated')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }

    public function deleteUser(int $id): JsonResponse
    {
        $res = $this->userProgressRepository->delete($id);

        if ($res) {
            return response()->json(['message' => __('message.user_progress.deleted')], StatusCode::OK->value);
        }

        return response()->json(['message' => __('message.user_progress.cant_deleted')], StatusCode::INTERNAL_SERVER_ERROR->value);
    }

    public function getTodayQuestionCard($userId): array
    {
        // dont use resource class.
        // dont check permission
        $todayNewCards = $this->userProgressRepository->getTodayNewQuestionCards($userId)->select('id', 'question');
        $todayReviewCards = $this->userProgressRepository->getTodayReviewCards($userId)->select('id', 'question');

        return array_merge(['todayNewCards' => $todayNewCards], ['todayReviewCards' => $todayReviewCards]);
    }

    public function checkAnswerUserAndUpdateUserProgress(SendAnswerQuestionCardsRequest $request): JsonResponse
    {
        // good.
        $userProgress = $this->userProgressRepository->getOneById($request['user_progress_id']);
        $questionCard = $this->questionCardRepository->getOneById($userProgress->question_card_id);

        $correctAnswer = trim($questionCard->answer);
        $userAnswer = trim($request['answer']);

        $reviewCount = $userProgress->review_count += 1;
        $interval = pow($reviewCount, 2);
        $today = Carbon::now()->format('Y-m-d');

        $nextReviewDate = buildNextReviewDateForUserProgressService::buildNextReviewDate($interval);
        $tomorrow = Carbon::tomorrow();

        $userProgressLogData = [
            'user_progress_id' => $userProgress->id,
            'user_id' => $userProgress->user_id,
            'last_review_date' => $today,
            'last_review_status' => 'forget',
        ];

        $userProgressData = [
            'last_review_date' => $today,
            'review_count' => 0,
            'interval' => 0,
            'next_review_date' => $tomorrow,
            'last_review_status' => 'forget'
        ];

        if ($correctAnswer === $userAnswer) {

            $userProgressLogData['last_review_status'] = 'learn';
            $userProgressData['last_review_status'] = 'learn';

            $userProgressData['review_count'] = $reviewCount;
            $userProgressData['interval'] = $interval;
            $userProgressData['next_review_date'] = $nextReviewDate;

            $this->userProgressLogRepository->create($userProgressLogData);
            $res = $this->userProgressRepository->update($userProgress->id, $userProgressData);

            if ($res) {
                return response()->json(__('card_read_successFull'), StatusCode::OK->value);
            }

            return response()->json(__('cant_card_read'), StatusCode::INTERNAL_SERVER_ERROR->value);
        }

        $this->userProgressLogRepository->create($userProgressLogData);
        $res = $this->userProgressRepository->update($userProgress->id, $userProgressData);

        if ($res) {
            return response()->json(__('delete_card'), StatusCode::OK->value);
        }
    }
}
