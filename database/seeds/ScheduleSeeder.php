<?php

use Illuminate\Database\Seeder;

use App\Users\User;
use App\Drive\Assignment;
use App\Drive\DriveGroup;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $when  = Carbon::now();
        $group = DriveGroup::first();
        $users = $group->members;

        foreach (range(0, 20) as $index) {
            $user = $users->random();
            $week = $when->weekOfYear;
            $year = $when->year;
            Assignment::create(['user_id' => $user->id, 'group_id' => $group->id, 'week' => $week, 'year' => $year]);

            $when->addWeeks(1);
        }
    }
}
