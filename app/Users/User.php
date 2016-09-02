<?php

namespace App\Users;

use App\Drive\DriveGroup;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'main_group_id',
        'github_id', 'facebook_id', 'google_id', 'uploaded_avatar', 'social_avatar', 'auth_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * User full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function groups()
    {
        return $this->belongsToMany(DriveGroup::class, 'drive_group_members');
    }

    public function mainGroup()
    {
        return $this->belongsTo(DriveGroup::class, 'main_group_id');
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function routeNotificationForSlack()
    {
        return $this->slack_webhook_url;
    }
}
