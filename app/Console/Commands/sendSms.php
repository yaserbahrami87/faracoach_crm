<?php

namespace App\Console\Commands;

use App\assessment;
use App\sms;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Kavenegar;

class sendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Send SMS';

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
        try {
            $sender = "10004002002020";
            $message = 'تست می باشد';
            $tel='09376578529';
            $receptor = array($tel);
            $result =NULL; //Kavenegar::Send($sender, $tel, $message);
            if ($result) {
                foreach ($result as $r) {
                    $messageid = $r->messageid;
                    $message = $r->message;
                    $status = $r->status;
                    $statustext = $r->statustext;
                    $sender = $r->sender;
                    $receptor = $r->receptor;
                    $date = $r->date;
                    $cost = $r->cost;
                }


                $msg=[];

            }

        } catch (\Kavenegar\Exceptions\ApiException $e)
        {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            if(Auth::check())
            {
                $insert_user_id=Auth::user()->id;
            }
            else
            {
                $insert_user_id=NULL;
            }


            $msg=[];
            $msg['msg'] = $e->errorMessage();
            $msg['status']=false;

            assessment::create([
                'subject'=>$msg['msg']
            ]);


        } catch (\Kavenegar\Exceptions\HttpException $e)
        {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            $msg=[];
            $msg['msg'] = $e->errorMessage();
            $msg['status'] =false;
            assessment::create([
                'subject'=>$msg['msg']
            ]);

        }
    }
}
