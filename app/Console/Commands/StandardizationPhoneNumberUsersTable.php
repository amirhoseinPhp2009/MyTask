<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class StandardizationPhoneNumberUsersTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Standardization:phoneNumber';

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
        $reserves = User::all();
        $data = ['.', '-', '_', '(', ')', ' '];

        foreach ($reserves as $reserve) {
            $replace = str_replace($data, '',$reserve->phone);
            $reserve->update(['phone' => $replace]);
        }

        $this->info('PhoneNumber edited', 'blue');
    }
}
