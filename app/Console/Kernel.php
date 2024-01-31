<?php

namespace App\Console;

use App\Jobs\ScheduleVaccination;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new ScheduleVaccination())
            ->everyMinute(); // for testing
            //->dailyAt('13:18')
            //->days(Schedule::SUNDAY . "-" . Schedule::THURSDAY);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
