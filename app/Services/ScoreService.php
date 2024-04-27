<?php

namespace App\Services;


use App\Setting;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ScoreService
{
   public static function Score(User $user)
   {
       $setting=Setting::where('setting','like','%score_%')
           ->get();
       $introduced=0;
       $total_introduced=0;
       $re_entry=0;
       $total=0;
       $total_Ambassador=[];


       /*  **********introduced*************************/
       $introduced=($user->get_invitations->count());
       $total_introduced=$introduced*$setting->where('setting','score_introduced')->first()->value;
       $total_Ambassador+=['totalIntroduced'=>$total_introduced];


       foreach ($user->get_invitations as $invite) {
//       *****************  re_entrty **********************
           $total+=self::subscore($invite);
       }
       $total_Ambassador+=['Score_final'=>$total+$total_introduced];
       $total_Ambassador+=['introduced'=>$total_introduced];
       $total_Ambassador+=['sub_total'=>$total];
       return $total_Ambassador;
   }

   public static function subscore (user $user)
   {
       $total_Ambassador=[];
       $total_re_entry=0;
       $product_purchase=0;
       $total_purchase=0;
       $total_subscore=0;
       $total_Score=0;
       $test=0;

       $setting=Setting::where('setting','like','%score_%')
           ->get();


       if($user->logs()->where('log_type','like','login')->count()!=0)
       {
//           $re_entry=($user->logs()->where('log_type','like','login')->groupby('log_date')->count()*$setting->where('setting','score_re_entry')->first()->value);
//           $test=$user->logs()->groupBy(LEFT(log_date,7))->having('log_type','like','login');

           $re_entry= $user->logs()
               ->selectRaw('log_date, user_id, log_type')
               ->groupByRaw('LEFT(log_date, 7), log_type, user_id')
               ->having('log_type', '=', 'login')
               ->count();
           $total_re_entry=$re_entry*$setting->where('setting','score_re_entry')->first()->value;
           $total_subscore+=$total_re_entry;

       }
       else
       {
           $re_entry=0;
       }

       //           ****************Purchase *********************
       $product_purchase+=($user->checkouts->where('status','=','1')->sum('price')/$setting->where('setting','score_product_purchase')->first()->value);
       $product_purchase+=($user->faktors->where('status','=',1)->sum('fi')/$setting->where('setting','score_product_purchase')->first()->value);
       $total_purchase+=$product_purchase;
       $total_subscore+=$total_purchase;
       return $total_subscore;
   }

}
