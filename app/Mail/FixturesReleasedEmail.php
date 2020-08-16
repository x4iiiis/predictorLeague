<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class FixturesReleasedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fixtures;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($matches)
    {
        $this->fixtures = $matches;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->from(['address' => 'noreply@predictorleague.x4iiiis.com', 'name' => 'Fixture Release'])
                    ->subject('New Fixtures Out Now!')
                    ->view('emails.predictionsReleased')
                    ->with([
                        'firstKickoff' => Carbon::parse($this->fixtures->first()->kickoff)->isoFormat('H:mm, dddd, MMMM Do'),
                        'matches' => $this->fixtures,
                    ]);
    }
}
