<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CachableBuilder extends Builder
{
    protected string $driverName;

    public function buildbase64StringWithParams(string $sql, array $bindings): string
    {
        $queryWithBindings = $sql . '|' . json_encode($bindings);

        return base64_encode($queryWithBindings);
    }

    protected function getModelsByCache(string $cacheKey)
    {
        $modelsFromCache = Cache::get($cacheKey);

        if ($modelsFromCache) {
            foreach ($modelsFromCache as $cache){
                $cache->drive = 'cache';
                $cache->cacheKey = $cacheKey;
            }
        }

        return $modelsFromCache;
    }

    protected function getModelsByDatabase($columns, string $cacheKey, bool $is_cache)
    {
        $response = $this->model->hydrate(
            $this->query->get()->all()
        )->all();

        foreach ($response as $res)
        {
            $res->driver = 'database';
            $res->cacheKey = $cacheKey;
            $res->querySyntax = $this->query->toSql();
            $res->bindings = $this->query->getBindings();
        }

        if ($is_cache) {
            Cache::forever($cacheKey, $response);
        }

        return $response;
    }

    public function getModels($columns = ['*'])
    {
        $builder = $this->query;
        $cacheKey = $this->buildbase64StringWithParams($builder->toSql(), $builder->getBindings());

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

    public function deleteCache(): bool
    {
        $cacheKey = $this->model->cacheKey;

        if (Cache::has($cacheKey)) {
            return Cache::forget($cacheKey);
        }
    }

    public function retryCache()
    {
        $cacheKey = $this->model->cacheKey;
        $query = $this->model->querySyntax;
        $bindings = $this->model->bindings;

        $data = DB::select($query, $bindings);
        $response = $this->hydrate($data)->all();

        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
        }

        foreach ($response as $res) {
            $res['driver'] = 'cache';
            $res['cacheKey'] = $cacheKey;
            $res['querySyntax'] = $query;
            $res['bindings'] = $bindings;
        }

        Cache::forever($cacheKey, $response);

        return $response;
    }


}
