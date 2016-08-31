<?php

namespace App\Events;

use App\Drive\Assignment;
use App\Notifications\AssignmentNotesWereUpdated;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AssignmentUserUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $assignment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        // Run notification if needed
        // if ($this->assignment->notes) $this->assignment->group->notify(new AssignmentNotesWereUpdated($this->assignment));

        return new Channel('assignments.user');
    }
}
