<?php

namespace App\Repositories\Task\ProductRepositoryDrivers;

use App\Interfaces\Task\BaseRepositoryInterface;
use Illuminate\Support\Collection;

class ProductMysqlRepository implements BaseRepositoryInterface
{
    public function connection(string $operation)
    {
    }

    public function getAll(): Collection
    {
    }

    public function getOneById($id): Collection
    {
    }

    public function create(): bool
    {
    }

    public function update(): bool
    {
    }

    public function delete(): bool
    {
    }
}
