<?php

namespace App\Jobs;

use App\Services\SendNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendMessageByTelegramBotJob implements ShouldQueue
{
    use Queueable;

    protected string $message;

    /**
     * Create a new job instance.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        SendNotificationService::SendNotificationByTelegramBot($this->message);
    }
}
