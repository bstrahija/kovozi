<?php

namespace App\Http\Controllers;

use App\Drive\Assignment;
use App\Drive\AssignmentRepository;
use App\Drive\DriveGroup;
use App\Http\Requests;
use App\Notifications\WhoDrivesNextWeek;
use App\Notifications\YouDriveNextWeek;
use App\Notifications\AssignmentNotesWereUpdated;
use App\Users\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Assignment repository
     *
     * @var AssignmentRepository
     */
    protected $assignments;

    /**
     * Init dependencies
     *
     * @param AssignmentRepository $assignments
     */
    public function __construct(AssignmentRepository $assignments)
    {
        $this->assignments = $assignments;
    }

    /**
     * Schedule overview
     *
     * @return View
     */
    public function index()
    {
        $schedule = $this->assignments->schedule();

        return view('schedule.index')->withThisWeek($schedule->thisWeek)
                                     ->withNextWeek($schedule->nextWeek)
                                     ->withHistory($schedule->history);
    }

    /**
     * Edit the schedule for future assignments
     *
     * @return View
     */
    public function edit()
    {
        $schedule = $this->assignments->schedule();

        return view('schedule.edit')->withSchedule($schedule);
    }
}
