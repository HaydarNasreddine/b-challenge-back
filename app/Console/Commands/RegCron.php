<?php

namespace App\Console\Commands;

use App\Services\UserService;
use Illuminate\Console\Command;

class RegCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regcron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send the number of new registrars by email (daily)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->userService->getNewRegistrarsCount();
        //send the {$count} value by email
        return 0;
    }
}
