<?php

namespace App\Listeners;

use App\Repositories\CommandTask\CommandQueryLogRepository;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class CommandStartingListener
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
    public function handle(object $event): void
    {
        DB::listen(function ($query) {
            $data = [
                'command' => 'test',
                'query' => $query->sql,
                'bindings' => json_encode($query->bindings),
                'time' => $query->time,
                'connection_name' => $query->connectionName,
                'created_at' => now()
            ];

            $this->commandQueryLogRepository->create($data);
        });
    }
}
