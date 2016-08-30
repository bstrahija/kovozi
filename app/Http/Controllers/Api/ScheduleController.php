<?php

namespace App\Http\Controllers\Api;

use Response;
use App\Drive\AssignmentRepository;

use App\Drive\Assignment;
use App\Drive\DriveGroup;
use App\Http\Requests;
use App\Notifications\WhoDrivesNextWeek;
use App\Notifications\YouDriveNextWeek;
use App\Notifications\AssignmentNotesWereUpdated;
use App\Users\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
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
     * @return Response
     */
    public function index()
    {
        $schedule = $this->assignments->schedule();

        return Response::json($schedule->toArray());
    }

    /**
     * This weeks assignment
     *
     * @return Response
     */
    public function thisWeek()
    {
        $thisWeek = $this->assignments->thisWeek();

        return Response::json($thisWeek);
    }

    /**
     * Next weeks assignment
     *
     * @return Response
     */
    public function nextWeek()
    {
        $nextWeek = $this->assignments->nextWeek();

        return Response::json($nextWeek);
    }

    /**
     * History of assignments
     *
     * @return Response
     */
    public function history()
    {
        $history = $this->assignments->history();

        return Response::json($history);
    }

    /**
     * Update assignment notes
     *
     * @param  integer  $assignmentId
     * @param  Request $request
     * @return Response
     */
    public function updateNotes($assignmentId, Request $request)
    {
        $assignment = Assignment::find($assignmentId);

        $assignment->update(['notes' => $request->input('notes')]);

        if ($request->input('notes')) $assignment->group->notify(new AssignmentNotesWereUpdated($assignment));

        return Response::json($assignment);
    }
}
