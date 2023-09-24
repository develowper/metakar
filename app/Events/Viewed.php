<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Viewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $viewClass;
    public $title;
    public $isMeta;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data, $viewClass, $title, $isMeta = false)
    {
        $this->viewClass = $viewClass;
        $this->title = $title;
        $this->isMeta = $isMeta;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-viewed');
    }
}
