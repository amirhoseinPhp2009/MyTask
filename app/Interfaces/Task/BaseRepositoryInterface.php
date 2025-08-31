<?php

namespace App\Interfaces\Task;

use Illuminate\Support\Collection;

interface baseRepositoryInterface
{
    public function connection ();

    public function getAll(): Collection;

    public function getOneById($id): Collection;

    public function create(array $data): bool;

    public function update($id, array $data): bool;

    public function delete($id): bool;
}
