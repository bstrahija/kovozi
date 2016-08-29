<?php

namespace App\Drive;

use App\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DriveGroup extends Model
{
    use Notifiable;

    protected $fillable = ['title'];

    public function members()
    {
        return $this->belongsToMany(User::class, 'drive_group_members');
    }

    public function routeNotificationForSlack()
    {
        return env('SLACK_WEBHOOK_URL');
    }
}
