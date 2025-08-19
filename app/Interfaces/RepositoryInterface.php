<?php

namespace App\Interfaces;

use Illuminate\Database\Query\Builder;

interface RepositoryInterface
{
    public function table () : Builder;
    public function getOneById (int $id);
    public function create (array $data): bool;
    public function update (int $id, array $data): bool;
    public function delete (int $id): bool;
}
