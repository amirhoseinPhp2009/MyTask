<?php

namespace App\Providers;


use App\Events\SendMessageByTelegramBotEvent;
use App\Listeners\SendMessageByTelegramBotListener;
use Illuminate\Auth\Notifications\ResetPassword;
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
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Event::listen(SendMessageByTelegramBotEvent::class, SendMessageByTelegramBotListener::class);
    }
}
