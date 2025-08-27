<?php

namespace App\Repositories\Task;

use App\Interfaces\Task\SetDriverRepositoryInterface;
use Exception;

class ProductSetDriverRepository implements SetDriverRepositoryInterface
{
    public function setDriver(string $driver): object
    {
        $repositoryNameSpace = 'App\\Repositories\\Task\\ProductRepositoryDrivers\\Product' . $driver . 'Repository';

        if (class_exists($repositoryNameSpace)) {
            return new $repositoryNameSpace();
        }

        return new Exception('Driver Not Exits !!');
    }
}
