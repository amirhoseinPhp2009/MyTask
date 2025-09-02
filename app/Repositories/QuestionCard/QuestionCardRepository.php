<?php

namespace App\Repositories\QuestionCard;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class QuestionCardRepository implements RepositoryInterface
{
    public function table(): Builder
    {
        return DB::table('question_cards');
    }

    public function getOneById($id)
    {
        return $this->table()->where('id' ,$id)->first();
    }

    public function create(array $data): bool
    {
        return $this->table()->insert($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->table()->where('id' ,$id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->table()->where('id' ,$id)->delete();
    }
}
