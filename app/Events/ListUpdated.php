<?php

namespace App\Events;

use App\Models\ListItem;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ListUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public ListItem $listItem) {}


    public function broadcastOn(): array
    {
        return [new Channel('listItems')];
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->listItem->id,
            'name' => $this->listItem->name,
            'is_completed' => $this->listItem->is_completed,
            'updated_at' => $this->listItem->updated_at,
        ];
    }
}
