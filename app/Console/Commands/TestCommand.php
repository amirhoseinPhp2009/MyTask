<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use NunoMaduro\Collision\ConsoleColor;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\ConsoleOutput;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

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
        $this->info("<fg=white;bg=blue;options=bold>Test</>");
        $this->info("<fg=white;bg=red;options=bold>Test</>");
        $this->info("<fg=white;bg=yellow;options=bold>Test</>");

        Log::channel('telegram')->info("Test");
    }
}
