<?php

namespace App\Listeners;

use App\Repositories\CommandTask\CommandQueryLogRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CommandFinishedListener
{
    /**
     * Create the event listener.
     */
    protected CommandQueryLogRepository $commandQueryLogRepository;

    public function __construct(CommandQueryLogRepository $commandQueryLogRepository)
    {
        $this->commandQueryLogRepository = $commandQueryLogRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(): void
    {
        $queries = Cache::get('commandQueryDataCache');
        if (null === $queries) {
            return;
        }

        DB::table('command_query_logs')->insert($queries);

        Cache::forget('commandQueryDataCache');
    }
}
