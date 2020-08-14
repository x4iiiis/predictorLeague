<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FixturesReleasedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $fixtures;

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
        // dd($this->fixtures->first());
        
        return $this->from(['address' => 'noreply@predictorleague.x4iiiis.com', 'name' => 'Fixture Release'])
                    ->view('emails.predictionsReleased')
                    ->with([
                        'firstKickoff' => $this->fixtures->first()->kickoff,
                        'matches' => $this->fixtures,
                    ]);
    }
}
