<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\ProcessSettlementsJob;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use App\Events\ProcessSettlements;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        Log::debug("Inside Kernel Command");
        $schedule->command('pending-payout-orders')->everyFifteenMinutes();
        //$schedule->command('queue:work')->everyMinute();
        //$schedule->job(new ProcessSettlementsJob)->everyMinute();
        event(new ProcessSettlements());
        
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
