<?php

use App\Users\User;
use App\Drive\DriveGroup;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = DriveGroup::first();

        $user = User::create(['email' => 'bstrahija@gmail.com',    'first_name' => 'Boris',  'last_name' => 'Strahija', 'nickname' => 'Boris', 'password' => 'influendo', 'main_group_id' => $group->id, 'slack_webhook_url' => 'https://hooks.slack.com/services/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']);
        $user->groups()->save($group); $group->user_id = $user->id; $group->save();
        $user = User::create(['email' => 'fffilo666@gmail.com',    'first_name' => 'Franjo', 'last_name' => 'Filo',     'nickname' => 'Filo',  'password' => 'influendo', 'main_group_id' => $group->id, 'slack_webhook_url' => 'https://hooks.slack.com/services/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']);
        $user->groups()->save($group);
        $user = User::create(['email' => 'zjambor11@gmail.com',    'first_name' => 'Zoran',  'last_name' => 'Jambor',   'nickname' => 'Zoki',  'password' => 'influendo', 'main_group_id' => $group->id, 'slack_webhook_url' => 'https://hooks.slack.com/services/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']);
        $user->groups()->save($group);
        $user = User::create(['email' => 'davor.jambor@gmail.com', 'first_name' => 'Davor',  'last_name' => 'Jambor',   'nickname' => 'Dado',  'password' => 'influendo', 'main_group_id' => $group->id, 'slack_webhook_url' => 'https://hooks.slack.com/services/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']);
        $user->groups()->save($group);
    }
}
