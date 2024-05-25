<?php

namespace App\Console\Commands;

use App\Http\Controllers\BaseController;
use App\scholarship;
use Illuminate\Console\Command;

class SendNotificationCompleteProfile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendSms:completeProfile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send SMS for complete profile';

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
            $msg="⚠️توجه"."\n"."لطفا پروفایل بورسیه خود را ظرف 24 ساعت تکمیل کنید"."\n".asset('/sch2024/register?introduce='.$scholarship->user->id ."\nفراکوچ");
            $BaseController->sendSms($scholarship->user->tel,$msg);
        }
        $this->info('send sms for complete Profile');
    }
}
