<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PredictionsReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $reminder;

    /**
     * Create a new message instance.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
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
                        'firstKickoff' => $this->reminder->kickoff,
                        'matches' => $this->reminder->matches,
                    ]);
    }
}
