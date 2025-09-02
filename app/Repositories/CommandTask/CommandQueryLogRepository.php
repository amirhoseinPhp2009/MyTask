<?php

namespace App\Repositories\CommandTask;

use App\Interfaces\Task\baseRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CommandQueryLogRepository implements baseRepositoryInterface
{
    public function connection()
    {
        return DB::table('command_query_logs');
    }

    public function getAll(): Collection
    {
        return $this->connection()->get()->all();
    }

    public function getOneById($id): Collection
    {
        return $this->connection()->get($id);
    }

    public function insert(array $data)
    {
        $this->connection()->insert($data);
    }

    public function update($id, array $data): bool
    {
        return $this->getOneById($id)->update($data);
    }

    public function delete($id): bool
    {
        return $this->getOneById($id)->delete($id);
    }
}
