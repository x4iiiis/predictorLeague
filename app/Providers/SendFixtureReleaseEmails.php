<?php

namespace App\Providers;

use App\Providers\FixturesReleased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\FixturesReleasedEmail;
use Carbon\Carbon;

class SendFixtureReleaseEmails implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FixturesReleased  $event
     * @return void
     */
    public function handle(FixturesReleased $event)
    {
        foreach($event->fixtures as $fixture) {
            $fixture->kickoff = Carbon::parse($fixture->kickoff)->isoFormat('H:mm, dddd, MMMM Do');
        }

        foreach ($event->users as $recipient) {
            Mail::to($recipient->email)->queue(new FixturesReleasedEmail($event->fixtures));
        }
    }
}
