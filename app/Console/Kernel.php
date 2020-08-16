<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
Use App\Match;
Use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PredictionsReminder;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            // If it's 9am 
            if(Carbon::now('Europe/London')->hour == 11 && Carbon::now('Europe/London')->minute == 45) {
                // If today is matchday
                if(Carbon::parse(Match::where('homeGoals', null)->first()->kickoff)->isToday()) {
                    // find all users who have not yet submitted predictions
                    $recipients = User::where('hasSubmitted', false)->where('accept_emails', true)->get();
                    // email them all a reminder
                    $fixtures = Match::where('homeGoals', null)->get();

                    foreach ($recipients as $recipient) {
                        Mail::to($recipient->email)->queue(new PredictionsReminder($fixtures));
                    }
                }
            }
        })->everyMinute();
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
