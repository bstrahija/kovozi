<?php

namespace App\Notifications;

use App\Drive\Assignment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class AssignmentNotesWereUpdated extends Notification
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
        $text = 'Napomena za tjedan '.$this->assignment->week.'/'.$this->assignment->year.': ';

        // This week
        if ($this->assignment->week == Carbon::now()->weekOfYear and $this->assignment->year == Carbon::now()->year) {
            $text = 'Napomena za ovaj tjedan: ';

        // Next week
        } elseif ($this->assignment->week == Carbon::now()->addWeeks(1)->weekOfYear and $this->assignment->year == Carbon::now()->addWeeks(1)->year) {
            $text = 'Napomena za slijedeći tjedan: ';
        }

        return (new SlackMessage)
                    ->content($text . "\n" .  '*' . $this->assignment->notes . '*');
    }
}
