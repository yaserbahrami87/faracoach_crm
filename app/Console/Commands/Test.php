<?php

namespace App\Console\Commands;

use App\Http\Controllers\BaseController;
use App\scholarship;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendSms:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test completed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $BaseController=new BaseController();
        $BaseController->sendSms("09376578529",'تست کامند');
        $this->info('Test Completed');
    }
}
