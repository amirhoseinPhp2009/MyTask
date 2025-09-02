<?php

namespace App\Providers;

use App\Listeners\CommandFinishedListener;
use App\Listeners\CommandStartingListener;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        User::observe(UserObserver::class);

        Event::listen(CommandStarting::class, CommandStartingListener::class);
        Event::listen(CommandFinished::class, CommandFinishedListener::class);
    }
}
