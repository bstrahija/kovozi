<?php

namespace App\Http\Controllers\Api;

use Response;
use App\Drive\AssignmentRepository;
use App\Drive\Assignment;
use App\Drive\DriveGroup;
use App\Http\Requests;
use App\Events\AssignmentNoteUpdated;
use App\Events\AssignmentUserUpdated;
use App\Users\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
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
     * Upcoming assignments
     *
     * @return Response
     */
    public function upcoming()
    {
        $upcoming = $this->assignments->upcoming();

        return Response::json($upcoming);
    }

    /**
     * Users in main group
     *
     * @return Response
     */
    public function groupUsers()
    {
        return Response::json(\App\Users\User::where('main_group_id', 1)->get());
    }

    /**
     * Update assignment notes
     *
     * @param  integer  $assignmentId
     * @param  Request $request
     * @return Response
     */
    public function update($assignmentId, Request $request)
    {
        // Find assignment and update the data
        $assignment = Assignment::find($assignmentId);

        // Update notes
        if ($request->has('notes')) {
            $assignment->update(['notes' => $request->input('notes')]);

            // Trigger the event
            event(new AssignmentNoteUpdated($assignment));
        }

        // Update user
        if ($request->has('user_id')) {
            $assignment->update(['user_id' => $request->input('user_id')]);

            // Trigger the event
            event(new AssignmentUserUpdated($assignment));
        }

        return Response::json($assignment);
    }
}
