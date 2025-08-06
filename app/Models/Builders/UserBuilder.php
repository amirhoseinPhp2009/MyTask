<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserBuilder extends Builder
{
    public function buildUniqueStringHash(string $sql, array $bindings): string
    {
        $queryWithBindings = $sql . '|' . json_encode($bindings);

        return base64_encode($queryWithBindings);
    }

    public function getModels($columns = ['*'])
    {
        $builder = $this->query;
        $cacheKey = $this->buildUniqueStringHash($builder->toSql(), $builder->getBindings());

        if (Cache::has($cacheKey)) {
            $getCache = Cache::get($cacheKey);
//            $getCache['driver'] = 'cache';

            return $getCache;
        }

        $response = $this->model->hydrate(
            $this->query->get($columns)->all()
        )->all();

//        $response['driver'] = 'database';

        Cache::forever($cacheKey, $response);

        return $response;
    }
}
