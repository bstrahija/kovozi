<?php

namespace App\Console\Commands;

use App\Users\UserRepository;
use Illuminate\Console\Command;

class SendNotificationsForNextWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:next-week';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out notifications for next week.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = $this->users->sendNextWeekNotificationsForGroup(1);

        $this->line("Sent out {$count} notifications.");
    }
}
