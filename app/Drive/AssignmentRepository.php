<?php

namespace App\Drive;

use Auth, Carbon\Carbon;
use App\Services\EloquentRepository;

class AssignmentRepository extends EloquentRepository
{
    /**
     * Eloquent model for repository
     *
     * @var string
     */
    protected $model = 'App\Drive\Assignment';

    public function schedule($when = null)
    {
        // Set date
        if ( ! $when) $when = Carbon::now();

        // Get data
        $history  = Assignment::with(['user', 'group'])->where('week', '<', $when->weekOfYear)->where('year', '<=', $when->year)->orderBy('year', 'desc')->orderBy('week', 'desc')->limit(10)->get();
        $thisWeek = Assignment::with(['user', 'group'])->where('week', $when->weekOfYear)->where('year', $when->year)->first();
        $nextWeek = Assignment::with(['user', 'group'])->where('week', $when->addWeeks(1)->weekOfYear)->where('year', $when->year)->first();
        $upcoming = Assignment::with(['user', 'group'])->where('week', '>=', $when->weekOfYear)->where('year', '>=', $when->year)->orderBy('year', 'asc')->orderBy('week', 'asc')->limit(10)->get();

        return new Schedule($thisWeek, $nextWeek, $history, $upcoming);
    }

    /**
     * Assignment for this week
     *
     * @param  DateTime $when
     * @return Assignment
     */
    public function thisWeek($when = null)
    {
        // Set date
        if ( ! $when) $when = Carbon::now();

        // Get data
        $thisWeek = Assignment::with(['user', 'group'])->where('week', $when->weekOfYear)->where('year', $when->year)->first();

        return $thisWeek;
    }

    /**
     * Assignment for next week
     *
     * @param  DateTime $when
     * @return Assignment
     */
    public function nextWeek($when = null)
    {
        // Set date
        if ( ! $when) $when = Carbon::now();

        // Get data
        $nextWeek = Assignment::with(['user', 'group'])->where('week', $when->addWeeks(1)->weekOfYear)->where('year', $when->year)->first();

        return $nextWeek;
    }

    /**
     * History of assignments
     *
     * @param  integer   $count
     * @param  DateTime  $when
     * @return Collection
     */
    public function history($count = 10, $when = null)
    {
        // Set date
        if ( ! $when) $when = Carbon::now();

        // Get data
        $history  = Assignment::with(['user', 'group'])->where('week', '<', $when->weekOfYear)->where('year', '<=', $when->year)->orderBy('year', 'desc')->orderBy('week', 'desc')->limit($count)->get();

        return $history;
    }

    /**
     * Upcoming assignments
     *
     * @param  integer   $count
     * @param  DateTime  $when
     * @return Collection
     */
    public function upcoming($count = 10, $when = null)
    {
        // Set date
        if ( ! $when) $when = Carbon::now();

        // Get data
        $history  = Assignment::with(['user', 'group'])->where('week', '>=', $when->weekOfYear)->where('year', '>=', $when->year)->orderBy('year', 'asc')->orderBy('week', 'asc')->limit($count)->get();

        return $history;
    }
}
