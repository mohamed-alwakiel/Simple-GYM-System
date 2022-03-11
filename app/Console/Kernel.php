<?php

namespace App\Console;

use App\Console\Commands\NotifyUsers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        NotifyUsers::class,
      ];
      // run this command to start schedule ==========> php artisan schedule:work *=*=*=*=*=*=
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notify:users-not-logged-in-for-month')
                 ->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
