<?php

namespace App\Repositories\Task\ProductRepositoryDrivers;

use App\Interfaces\Task\BaseRepositoryInterface;
use Illuminate\Support\Collection;
use function collect;

class ProductFileRepository implements BaseRepositoryInterface
{
    public function connection(string $operation)
    {
        return fopen(public_path('products.txt'), "r");
    }

    public function getAll(): Collection
    {
        $file = $this->connection('r');
        $products = fread($file, filesize("products.txt"));

        return collect(json_decode($products));
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
