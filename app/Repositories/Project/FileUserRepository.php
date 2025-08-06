<?php

namespace App\Repositories\Project;

use App\Interfaces\UserRepositoryInterface;

class FileUserRepository implements UserRepositoryInterface
{
    protected function getUsers(): array
    {
        $path = storage_path('app\users\users.json');
        $getUsers = file_get_contents($path);

        return json_decode($getUsers, true);
    }

    public function getUser(int $id): array
    {
        $users = $this->getUsers();
        $result = [];

        foreach ($users as $user) {
            if ($user['id'] == $id) {
                $result[] = $user;
            }
        }

        return $result;
    }

    public function createUser(array $data): bool
    {
        $users = $this->getUsers();
        array_push($users, $data);

        return file_put_contents(storage_path('app\users\users.json'), json_encode($users, JSON_PRETTY_PRINT)) ?? false;
    }

    public function deleteUser(int $id): bool
    {
        $users = $this->getUsers();

        foreach ($users as $key => $value) {

            if ($value['id'] == $id) {
                 unset($users[$key]);
            }
        }
        $users = array_values($users);

       return file_put_contents(storage_path('app\users\users.json'), json_encode($users, JSON_PRETTY_PRINT)) ?? false;
    }
}
