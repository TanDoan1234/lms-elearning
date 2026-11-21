<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('exams:finalize-expired', function (App\Services\ExamGradingService $grading) {
    $this->info('Finalized '.$grading->finalizeExpired().' expired attempt(s).');
})->purpose('Grade in-progress exam attempts whose deadline has passed');

Schedule::command('exams:finalize-expired')->everyMinute()->withoutOverlapping();
