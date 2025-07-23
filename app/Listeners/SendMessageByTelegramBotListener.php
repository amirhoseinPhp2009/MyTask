<?php

namespace App\Listeners;

use App\Events\SendMessageByTelegramBotEvent;
use App\Services\SendNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessageByTelegramBotListener implements ShouldQueue
{
    public string $message;

    /**
     * Create the event listener.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Handle the event.
     */
    public function handle(SendMessageByTelegramBotEvent $event): void
    {
        SendNotificationService::SendNotificationByTelegramBot($this->message);
    }
}
