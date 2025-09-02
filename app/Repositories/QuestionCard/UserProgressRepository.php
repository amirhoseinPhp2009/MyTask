<?php

namespace App\Repositories\QuestionCard;

use App\Interfaces\RepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class UserProgressRepository implements RepositoryInterface
{
    public function table(): Builder
    {
        return DB::table('users_progress');
    }

    public function getOneById($id)
    {
        return $this->table()->where('id', $id)->first();
    }

    public function create(array $data): bool
    {
        return $this->table()->insert($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->table()->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->table()->where('id', $id)->delete();
    }

    public function getTodayNewQuestionCards($userId)
    {
        $now = Carbon::now()->format('Y-m-d');

        return $this->table()->join('question_cards', 'users_progress.question_card_id', '=', 'question_cards.id')
            ->select('question_cards.*', 'users_progress.*')
            ->where('user_id', $userId)
            ->where('next_review_date', $now)
            ->where('review_count', 0)
            ->get();
    }

    public function getTodayReviewCards($userId)
    {
        $now = Carbon::now()->format('Y-m-d');

        return $this->table()->join('question_cards', 'users_progress.question_card_id', '=', 'question_cards.id')->
        select('question_cards.*', 'users_progress.*')->
        where('user_id', $userId)->
        where('next_review_date', $now)->
        where('review_count', '!=', 0)->
        get();
    }
}
