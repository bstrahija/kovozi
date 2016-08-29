<?php

namespace App\Notifications;

use App\Drive\DriveGroup;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class WhoDrivesNextWeek extends Notification
{
    use Queueable;

    protected $group;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(DriveGroup $group)
    {
        $this->group = $group;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
                    ->content('Slijedeći tjedan vozi: ' . \App\Users\User::first()->full_name);
    }
}
