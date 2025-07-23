<?php

namespace App\Console\Commands;

use App\Models\Reserve;
use App\Services\TrackingCodeBuilderService;
use Illuminate\Console\Command;

class GenerateTrackingCodeToReservesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:trackingCode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $reserves = Reserve::all();

        $progressBar = $this->output->createProgressBar(count($reserves));
        $progressBar->setOverwrite(false);
        $progressBar->start();

        foreach ($reserves as $reserve) {
            $uniqueCode = TrackingCodeBuilderService::generateTrackingCode();
            $reserve->update(['tracking_code' => $uniqueCode]);
        }

        $progressBar->finish();

        $this->info('<fg=white;bg=blue;options=bold>Generated Tracking Code</>');

    }
}
