<?php

namespace App\Listeners;

use App\Repositories\CommandTask\CommandQueryLogRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CommandStartingListener
{
    /**
     * Create the event listener.
     */
    protected CommandQueryLogRepository $commandQueryLogRepository;
    protected array $queries = [];

    public function __construct(CommandQueryLogRepository $commandQueryLogRepository)
    {
        $this->commandQueryLogRepository = $commandQueryLogRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        DB::listen(function ($query) use ($event) {

            $queryData = [
                'command' => "php artisan " . $event->command,
                'query' => $query->sql,
                'bindings' => json_encode($query->bindings),
                'time' => $query->time,
                'connection_name' => $query->connectionName,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $this->queries[] = $queryData;
            Cache::put('commandQueryDataCache', $this->queries);
        });
    }
}
