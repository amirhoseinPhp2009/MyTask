<?php

namespace App\Interfaces\Task;

use Illuminate\Support\Collection;

interface baseRepositoryInterface
{
    public function connection (string $operation);

    public function getAll(): Collection;

    public function getOneById($id): Collection;

    public function create(): bool;

    public function update(): bool;

    public function delete(): bool;
}
