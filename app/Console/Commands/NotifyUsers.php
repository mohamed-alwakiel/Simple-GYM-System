<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WeMissYou;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyUsers extends Command implements ShouldQueue
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users-not-logged-in-for-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "notify users that didn't login for a month";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereDate('last_login' ,'<' ,Carbon::now()->subDays(30)->toDateTimeString())->get();
        foreach($users as $user) {
            $user->notify(new WeMissYou($user));
          }
    }
}
