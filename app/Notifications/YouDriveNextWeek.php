<?php

namespace App\Notifications;

use App\Drive\Assignment;
use App\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class YouDriveNextWeek extends Notification
{
    use Queueable;

    protected $assignment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $notifiable->slack_webhook_url ? ['slack'] : ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('KoVozi slijedeći tjedan')
                    ->line('Samo podsjetnik da si slijedeći tjedan ti na redu za vožnju.');
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
                    ->content('Samo podsjetnik da si slijedeći tjedan ti na redu za vožnju.');
    }
}
