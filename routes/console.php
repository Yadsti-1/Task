<?php

use App\Console\Commands\DeleteTaskPending;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(DeleteTaskPending::class)->timezone('America/Bogota')->everyMinute();

