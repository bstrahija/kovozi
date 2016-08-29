<?php

namespace App\Drive;

use App\Users\User;
use App\Drive\DriveGroup;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'drive_assignments';

    protected $fillable = ['user_id', 'week', 'year', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(DriveGroup::class);
    }
}
