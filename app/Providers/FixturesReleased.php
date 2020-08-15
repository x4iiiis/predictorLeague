<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Match;
use Carbon\Carbon;

class FixturesReleased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $fixtures;
    public $users;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($matches, $allUsers)
    {
        $this->fixtures = $matches;
        $this->users = $allUsers;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
