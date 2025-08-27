<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class getAllUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:get-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = Carbon::now();

        DB::listen(function ($query) {

            Log::channel('telegram')->info(json_encode($query));
        });

        $users = DB::table('users')->where('id', 5)->where('daily_read_count', 1)->get();
        $roles = DB::table('roles')->get()->all();
        $sessions = DB::table('sessions')->get()->all();
        $users_progress = DB::table('users_progress')->get()->all();
        $users_progress_logs = DB::table('users_progress_logs')->get()->all();
        $jobs = DB::table('jobs')->get()->all();

        $end = Carbon::now();
        $diff = $start->diff($end);
        $this->components->info($diff);
    }
}
