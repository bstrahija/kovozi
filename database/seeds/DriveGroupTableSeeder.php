<?php

use App\Drive\DriveGroup;
use Illuminate\Database\Seeder;

class DriveGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DriveGroup::create(['title' => 'Drive & Beer']);
    }
}
