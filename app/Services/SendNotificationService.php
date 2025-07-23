<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SendNotificationService
{
    public static function SendNotificationByTelegramBot(string $message): void
    {
        Log::channel('telegram')->info($message);
    }
}
