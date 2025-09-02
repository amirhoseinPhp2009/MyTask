<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class GenerateQuestionCardsToUsersJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = DB::table('users')->get();

        $minQuestionCardId = DB::table('question_cards')->orderBy('id', 'asc')->first()->id;
        $maxQuestionCardId = DB::table('question_cards')->orderBy('id', 'desc')->first()->id;

        foreach ($users as $user) {

            $userQuestionCardRawCount = DB::table('users_progress')->where('user_id', $user->id)->count();
            $count = $user->daily_read_count - $userQuestionCardRawCount;
            $limit = abs($count);

            for ($i = 0; $i < $limit; $i++) {
                $data = [
                    'user_id' => $user->id,
                    'question_card_id' => mt_rand($minQuestionCardId, $maxQuestionCardId),
                    'next_review_date' => Carbon::now()->format('Y-m-d'),
                    'review_count' => 0,
                    'interval' => 0
                ];

                DB::table('users_progress')->insert($data);
            }
        }
    }
}
