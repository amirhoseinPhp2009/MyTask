<?php

namespace App\Console\Commands;

use Illuminate\Console\OutputStyle;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class BaseCommand extends SymfonyCommand
{
    public function run(InputInterface $input, OutputInterface $output): int
    {
        $startCommandTime = Carbon::now();

        $this->output = $output instanceof OutputStyle ? $output : $this->laravel->make(
            OutputStyle::class, ['input' => $input, 'output' => $output]
        );

        $this->components = $this->laravel->make(Factory::class, ['output' => $this->output]);
        $this->configurePrompts($input);

        try {
            DB::listen(function ($query) {
//                $this->components->info(json_encode($query));
            });

            return parent::run(
                $this->input = $input, $this->output
            );
        } finally {
            $this->untrap();
            $endCommandTime = Carbon::now();

            $commandTineMessage = "Time : " . $startCommandTime->diff($endCommandTime);

            $this->components->info($commandTineMessage);
        }
    }
}
