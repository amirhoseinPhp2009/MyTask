<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    //??
    public function getUser (int $id): object|array;
    public function createUser(array $data): bool;
    public function deleteUser(int $id): bool;
}
