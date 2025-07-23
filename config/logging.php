<?php

use TheCoder\MonologTelegram\Attributes\EmergencyAttribute;
use TheCoder\MonologTelegram\Attributes\CriticalAttribute;
use TheCoder\MonologTelegram\Attributes\ImportantAttribute;
use TheCoder\MonologTelegram\Attributes\DebugAttribute;
use TheCoder\MonologTelegram\Attributes\InformationAttribute;
use TheCoder\MonologTelegram\Attributes\LowPriorityAttribute;

return [
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single', 'telegram'],
        ],

        'telegram' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => TheCoder\MonologTelegram\TelegramBotHandler::class,
            'handler_with' => [
                'token' => env('LOG_TELEGRAM_BOT_TOKEN'),
                'chat_id' => env('LOG_TELEGRAM_CHAT_ID'),
                'topic_id' => env('LOG_TELEGRAM_TOPIC_ID', null),
                'bot_api' => env('LOG_TELEGRAM_BOT_API', 'https://api.telegram.org/bot'),
                'proxy' => env('LOG_TELEGRAM_BOT_PROXY', null),
                'queue' => env('LOG_TELEGRAM_QUEUE', null),
                'timeout' => env('LOG_TELEGRAM_TIMEOUT', 5),
                'topics_level' => [
                    EmergencyAttribute::class => env('LOG_TELEGRAM_EMERGENCY_ATTRIBUTE_TOPIC_ID', null),
                    CriticalAttribute::class => env('LOG_TELEGRAM_CRITICAL_ATTRIBUTE_TOPIC_ID', null),
                    ImportantAttribute::class => env('LOG_TELEGRAM_IMPORTANT_ATTRIBUTE_TOPIC_ID', null),
                    DebugAttribute::class => env('LOG_TELEGRAM_DEBUG_ATTRIBUTE_TOPIC_ID', null),
                    InformationAttribute::class => env('LOG_TELEGRAM_INFORMATION_ATTRIBUTE_TOPIC_ID', null),
                    LowPriorityAttribute::class => env('LOG_TELEGRAM_LOWPRIORITY_ATTRIBUTE_TOPIC_ID', null),
                ]
            ],
            'formatter' => TheCoder\MonologTelegram\TelegramFormatter::class,
            'formatter_with' => [
                'tags' => env('LOG_TELEGRAM_TAGS', null),
            ],
        ],
    ],
];
