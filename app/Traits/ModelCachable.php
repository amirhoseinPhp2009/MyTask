<?php

namespace App\Traits;

use App\Models\Builders\CachableBuilder;
use Illuminate\Support\Facades\Cache;

trait ModelCachable
{
    public function newEloquentBuilder($query): CachableBuilder
    {
        return new CachableBuilder($query);
    }

    public static function clearCache(): bool
    {
        return Cache::flush();
    }

    public static function bootModelCachable(): void
    {
        $instance = new self();

        static::saving(function ($model) use ($instance) {
            $instance->clearCache();
            unset($model->attributes['driver']);
        });

        static::updating(function ($model) use ($instance) {
            $instance->clearCache();
            unset($model->attributes['driver']);
        });

        static::deleting(function () use ($instance) {
            $instance->clearCache();
        });
    }

}
