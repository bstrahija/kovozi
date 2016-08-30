<?php

namespace App\Drive;

use Auth, Hash;
use App\Services\EloquentRepository;
use Laravel\Socialite\Two\User as SocialUser;

class Schedule extends EloquentRepository
{
    protected $thisWeek;
    protected $nextWeek;
    protected $history;
    protected $data;

    /**
     * Init new schedule
     *
     * @param Assignment $thisWeek
     * @param Assignment $nextWeek
     * @param Collection $history
     */
    public function __construct($thisWeek = null, $nextWeek = null, $history = null)
    {
        $this->thisWeek = $thisWeek;
        $this->nextWeek = $nextWeek;
        $this->history  = $history;
        $this->data     = [
            'this_week' => &$this->thisWeek,
            'next_week' => &$this->thisWeek,
            'history'   => &$this->history,
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
