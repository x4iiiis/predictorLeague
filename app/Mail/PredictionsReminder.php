<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class PredictionsReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $fixtures;

    /**
     * Create a new message instance.
     *
     * @param  \App\Order  $order
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
        return $this->from(['address' => 'noreply@predictorleague.x4iiiis.com', 'name' => 'Prediction Reminder'])
                    ->view('emails.predictionsReminder')
                    ->with([
                        'firstKickoff' => Carbon::parse($this->fixtures->first()->kickoff)->isoFormat('H:mm'),
                        'matches' => $this->fixtures,
                    ]);
    }
}
