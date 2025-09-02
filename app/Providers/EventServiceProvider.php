<?php

namespace App\Providers;

use App\Listeners\CommandStartingListener;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot (): void
    {
//        Event::listen(QueryExecuted::class, CommandStartingListener::class);
    }

}
