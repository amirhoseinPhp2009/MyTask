<?php

namespace App\Repositories\Project;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class MysqlUserRepository implements UserRepositoryInterface
{
    protected function setTableConnection(): Builder
    {
        return DB::table('users');
    }
    public function getUser(int $id): object
    {
        return $this->setTableConnection()->find($id);
    }
    public function createUser(array $data): bool
    {
        return $this->setTableConnection()->insert($data);
    }
    public function deleteUser(int $id): bool
    {
        return $this->setTableConnection()->find($id)->delete();
    }
}
