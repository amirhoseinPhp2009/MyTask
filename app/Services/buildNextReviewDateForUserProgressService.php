<?php

namespace App\Services;

use Carbon\Carbon;

class buildNextReviewDateForUserProgressService
{
    public static function buildNextReviewDate($interval): string
    {
        $today = Carbon::now()->format('Y-m-d');
        $nextReviewDateCarbon = Carbon::create($today);

        return $nextReviewDateCarbon->addDays($interval)->format('Y-m-d');
    }
}
