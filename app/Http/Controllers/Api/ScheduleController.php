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
    public function __construct(AssignmentRepository $assignments)
    {
        $this->assignments = $assignments;
    }

    public function index()
    {
        $schedule = $this->assignments->schedule();

        return Response::json($schedule->toArray());
    }

    public function thisWeek()
    {
        $thisWeek = $this->assignments->thisWeek();

        return Response::json($thisWeek);
    }

    public function nextWeek()
    {
        $nextWeek = $this->assignments->nextWeek();

        return Response::json($nextWeek);
    }

    public function history()
    {
        $history = $this->assignments->history();

        return Response::json($history);
    }

    public function updateNotes($assignmentId, Request $request)
    {
        $assignment = Assignment::find($assignmentId);

        $assignment->update(['notes' => $request->input('notes')]);

        if ($request->input('notes')) $assignment->group->notify(new AssignmentNotesWereUpdated($assignment));

        return Response::json($assignment);
    }
}
