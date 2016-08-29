<?php

namespace App\Http\Controllers;

use App\Drive\Assignment;
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
    public function index()
    {
        $when     = Carbon::now();
        $thisWeek = Assignment::where('week', $when->weekOfYear)->where('year', $when->year)->first();
        $nextWeek = Assignment::where('week', $when->addWeeks(1)->weekOfYear)->where('year', $when->year)->first();

        return view('schedule.index')->withThisWeek($thisWeek)->withNextWeek($nextWeek);
    }

    public function updateNotes($assignmentId, Request $request)
    {
        $assignment = Assignment::find($assignmentId);

        $assignment->update(['notes' => $request->input('notes')]);

        $assignment->group->notify(new AssignmentNotesWereUpdated($assignment));

        return redirect()->route('home');
    }
}
