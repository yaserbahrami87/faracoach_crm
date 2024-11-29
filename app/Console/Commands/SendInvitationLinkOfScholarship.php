<?php

namespace App\Console\Commands;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ScholarshipController;
use App\scholarship;
use Illuminate\Console\Command;

class SendInvitationLinkOfScholarship extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendSms:linkInvitationScholarship';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send link invitation of scholarship';

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
        $scholarships=scholarship::where('resource','sch2024')
                                ->get();
        foreach ($scholarships as $scholarship)
        {
            $msg="لینک اختصاصی دعوت از دوستان"."\n"."برای افزایش امتیاز بورسیه"."\n".asset('/sch2024/register?introduce='.$scholarship->user->id."\nفراکوچ");
            $BaseController->sendSms($scholarship->user->tel,$msg);
        }
    }
}
