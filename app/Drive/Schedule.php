<?php

namespace App\Drive;

use Auth, Hash;
use App\Services\EloquentRepository;
use Laravel\Socialite\Two\User as SocialUser;

class Schedule extends EloquentRepository
{
    public $thisWeek;
    public $nextWeek;
    public $history;
    public $upcoming;
    protected $data;

    /**
     * Init new schedule
     *
     * @param Assignment $thisWeek
     * @param Assignment $nextWeek
     * @param Collection $history
     */
    public function __construct($thisWeek = null, $nextWeek = null, $history = null, $upcoming = null)
    {
        $this->thisWeek = $thisWeek;
        $this->nextWeek = $nextWeek;
        $this->history  = $history;
        $this->upcoming = $upcoming;
        $this->data     = [
            'this_week' => &$this->thisWeek,
            'next_week' => &$this->nextWeek,
            'history'   => &$this->history,
            'upcoming'  => &$this->upcoming,
        ];
    }

    /**
     * Return array representation
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
}
