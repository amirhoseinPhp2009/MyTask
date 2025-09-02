<?php

namespace App\Repositories\Project;

use App\Interfaces\UserRepositoryInterface;
use Exception as ExceptionAlias;

class UserRepository
{
    /**
     * @throws ExceptionAlias
     */
    public static function driver(string $driver): UserRepositoryInterface
    {
        return match ($driver) {
            'file' => new FileUserRepository(),
            'mysql' => new MysqlUserRepository(),
            default => new ExceptionAlias('The driver' . $driver . 'is not supported'),
        };
    }
}
