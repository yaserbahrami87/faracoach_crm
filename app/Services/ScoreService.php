<?php

namespace App\Services;


use App\Setting;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ScoreService
{
    public $introduced;
    public $setting;
    public $totalIntroduced;
    public $introducedscore;
    public $re_entry;
    Public $totalre_entry;
    public $Product_purchase=0;
    public $totalpurchase;
    public $totalscores=0;
    public $total_Ambassador=[];
    public $total_allscore=0;
    public $subscore;
    public $total_re_introducedscore;

    public $subintroduced;
    public $subsetting;
    public $subtotalIntroduced;
    public $subintroducedscore;
    public $subre_entry;
    Public $subtotalre_entry;
    public $subProduct_purchase=0;
    public $subtotalpurchase;
    public $subtotalscores=0;
    public $subtotal_Ambassador=[];
    public $subtotal_allscore=0;
    public $subsubscore;
    public $subtotal_re_introducedscore;







        public function __construct()
        {
            $this->setting=Setting::where('setting','like','%score_%')
                                ->get();
        }
        public  function ScoreAmbassador(User $user)
        {
                session()->put('totalscore',0);
                if(!is_null($user->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()))
                {
                    $this->re_entry=($user->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()->log_date);
                    $now = Carbon::now();
                    $month = $now->format('m');
                    if(substr($this->re_entry,5,2)==$month)
                    {
                        $this->totalre_entry=$this->totalre_entry+$this->setting->where('setting','score_re_entry')->first()->value;
                        $this->totalscores= $this->totalscores+$this->totalre_entry;
                        $this->total_Ambassador+=['totalre_entry'=>$this->totalre_entry];
                        /* dd($this->total);*/
                    }
                }
            /*  **********  *************************/
              return $this->total_Ambassador;
        }


        public static function invitation( User $user)
        {
            $setting=Setting::where('setting','like','%score_%')
                ->get();
            $totalIntroduced=0;
            $introducedscore=0;
            $total_Ambassador=[];
            $subtotal_Ambassador=[];
            $Product_purchase=0;
            $totalpurchase=0;
            $totalre_entry=0;
            $totalscores=0;
            $subtotalpurchase=0;
            $subtotalre_entry=0;
            $subtotalscores=0;
            $subProduct_purchase=0;
            $subtotal_allscore=0;
            $total_re_introducedscore=0;

            session()->put('totalscore',0);
            /*  **********introduced*************************/

            $introduced=($user->get_invitations->count());
            $totalIntroduced=$introduced*$setting->where('setting','score_introduced')->first()->value;
            $introducedscore+=$totalIntroduced;
            $total_Ambassador+=['totalIntroduced'=>$introducedscore];

            /*  ********** Product_purchase *************************/

            $Product_purchase+=($user->checkouts->where('status','=','1')->sum('price')/$setting->where('setting','score_product_purchase')->first()->value);
            $Product_purchase+=($user->faktors->where('status','=',1)->sum('fi')/$setting->where('setting','score_product_purchase')->first()->value);
            $totalpurchase+=$Product_purchase;
            $total_Ambassador+=['Product_purchase'=>$totalpurchase];

            /*  ********** Re Entry *************************/

            if(!is_null($user->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()))
            {
                $re_entry=($user->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()->log_date);
                $now = Carbon::now();
                $month = $now->format('m');
                if(substr($re_entry,5,2)==$month)
                {
                    $totalre_entry+=$setting->where('setting','score_re_entry')->first()->value;
                    $totalscores+=$totalre_entry;
                    $total_Ambassador+=['totalre_entry'=>$totalre_entry];
                    /* dd($this->total);*/
                }
            }
            else
            {
                $total_Ambassador+=['totalre_entry'=>0];
            }

            /*  ********** Re introduced *************************/

//            foreach ($user->get_invitations as $invites)
//            {
//                /*  **********introduced*************************/
//                $subintroduced=($invites->get_invitations->count());
//                $subtotalIntroduced=$subintroduced*$setting->where('setting','score_introduced')->first()->value;
//                $subtotalscores+=$subtotalIntroduced;
//                $subtotal_Ambassador+=['subtotalIntroduced'=> $subtotalIntroduced];
//                /*  ********** Product_purchase *************************/
//                $subProduct_purchase+=($invites->checkouts->where('status','=','1')->sum('price')/$setting->where('setting','score_product_purchase')->first()->value);
//                $subProduct_purchase+=($invites->faktors->where('status','=',1)->sum('fi')/$setting->where('setting','score_product_purchase')->first()->value);
//                $subtotalpurchase+=$subProduct_purchase;
//                $subtotalscores+=$subtotalpurchase;
//                $subtotal_Ambassador+=['subProduct_purchase'=>$subtotalpurchase];
//                /*  ********** Re Entry *************************/
//                if(!is_null($invites->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()))
//                {
//                    $subre_entry=($invites->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()->log_date);
//                    $now = Carbon::now();
//                    $month = $now->format('m');
//                    if(substr($subre_entry,5,2)==$month)
//                    {
//                        $subtotalre_entry+=$setting->where('setting','score_re_entry')->first()->value;
//                        $subtotalscores+=$subtotalre_entry;
//                        $subtotal_Ambassador+=['subtotalre_entry'=>$subtotalre_entry];
//                        /* dd($this->total);*/
//                    }
//                }
//                else
//                {
//                    $subtotal_Ambassador+=['subtotalre_entry'=>0];
//                }
//                $subtotal_allscore+=$subtotalscores;
//            }
//
//                $total_re_introducedscore=$subtotal_allscore/10;
//                $total_Ambassador+=['total_re_introducedscore'=>$total_re_introducedscore];

            $totalscores=$totalre_entry+$totalIntroduced+$totalpurchase;
            $total_Ambassador+=['totalscores'=>$totalscores];
            session()->put('totalscoreUser',session('totalscoreUser')+$totalscores);
            return $total_Ambassador;
        }
}
