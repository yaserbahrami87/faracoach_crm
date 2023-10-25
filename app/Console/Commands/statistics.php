<?php

namespace App\Console\Commands;

use App\checkout;
use App\followup;
use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Console\Command;

class statistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $date_jalali=verta()->formatGregorian('Y-n-j');
        $knot_users=User::where('resource','=','کمپین گره')
                    ->where('created_at','like',$date_jalali.'%')
                    ->count();
        $scholarship_users=User::where('resource','=','بورسیه تحصیلی')
            ->where('created_at','like',$date_jalali.'%')
            ->count();

        $other_users=User::whereNull('resource')
            ->where('created_at','like',$date_jalali.'%')
            ->count();

        $customer=followup::where('status_followups','=',20)
            ->where('created_at','like',$date_jalali.'%')
            ->count();


        //میزان واریزی امروز
        $checkoutToday=checkout::where('created_at','like','%'.$date_jalali.'%')
                            ->where('status','=',1)
                            ->sum('price');

        $msg="گره:$knot_users \nبورسیه:$scholarship_users \nسایر:$other_users \nمشتری:$customer \nواریز:$checkoutToday";

        $BaseController->sendSms('09376578529',$msg);
        $BaseController->sendSms('09120769020',$msg);

    }
}
