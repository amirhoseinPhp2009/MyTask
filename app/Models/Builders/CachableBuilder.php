<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class CachableBuilder extends Builder
{
    protected string $driverName;

    public function buildUniqueStringHash(string $sql, array $bindings): string
    {
        $queryWithBindings = $sql . '|' . json_encode($bindings);

        return base64_encode($queryWithBindings);
    }

    protected function getModelsByCache(string $cacheKey)
    {
        $getCache = Cache::get($cacheKey);

        if ($getCache)
        {
            foreach ($getCache as $cache) {
                $cache->driver = 'cache';
            }
        }

        return $getCache;
    }

    protected function getModelsByDatabase($columns, string $cacheKey, bool $is_cache)
    {
        $response = $this->model->hydrate(
            $this->query->get($columns)->all()
        )->all();

        foreach ($response as $resp) {
            $resp->driver = 'database';
        }

        if ($is_cache) {
            Cache::forever($cacheKey, $response);
        }

        return $response;
    }

    public function getModels($columns = ['*'])
    {
        $builder = $this->query;
        $cacheKey = $this->buildUniqueStringHash($builder->toSql(), $builder->getBindings());

        if (isset($this->driverName) && 'database' === $this->driverName) {
            return $this->getModelsByDatabase($columns, $cacheKey, false);
        }

        if (Cache::has($cacheKey)) {
            return $this->getModelsByCache($cacheKey);
        }

        return $this->getModelsByDatabase($columns, $cacheKey, true);
    }

    public function driver(string $driver)
    {
        $this->driverName = $driver;

        return $this;
    }

    public function retry($columns = ['*'])
    {
        $builder = $this->query;
        $cacheKey = $this->buildUniqueStringHash($builder->toSql(), $builder->getBindings());

        if (Cache::has($cacheKey)) {
            Cache::delete($cacheKey);
        }

        $resp = $this->getModelsByDatabase($columns, $cacheKey, true);

        foreach ($resp as $res) {
            $res->driver = 'cache';
        }

        return $resp;
    }
}
