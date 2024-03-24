<?php

namespace App\Services;


use App\Setting;
use App\User;
use Illuminate\Support\Carbon;

class ScoreService
{
    public $introduced;
    public $setting;
    public $totalIntroduced;
    public $re_entry;
    Public $totalre_entry;
    public $Product_purchase=0;
    public $totalpurchase;
    public $totalscores=0;
    public $total_Ambassador=[];
    public $total_allscore=0;
        public function __construct()
        {
            $this->setting=Setting::where('setting','like','%score_%')
                                ->get();
        }
        public  function ScoreAmbassador(User $user)
        {

        /*  **********introduced*************************/

//            $this->introduced=($user->get_invitations->count());
//
//            $this->totalIntroduced=$this->introduced*$this->setting->where('setting','score_introduced')->first()->value;
//            $this->totalscores= $this->totalscores+$this->totalIntroduced;
//            $this->total_Ambassador+=['totalIntroduced'=> $this->totalIntroduced];


        /*  ********** Re Entry *************************/
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
        /*  ********** Product_purchase *************************/

            /* dd($this->Product_purchase=($user->checkouts->where('status','=','1')->count()));*/

//            foreach ($user->get_invitations as $invite)
//            {
//
//                $this->Product_purchase+=($invite->checkouts->where('status','=','1')->sum('price'));
//
//            }
//
//            $this->totalpurchase=$this->totalpurchase+($this->Product_purchase/$this->setting->where('setting','score_product_purchase')->first()->value);
//            $this->totalscores= $this->totalscores+$this->totalpurchase;
//            $this->total_Ambassador+=['totalre_purchase'=>$this->totalpurchase];
//
//            $this->total_Ambassador+=['totalscores'=>$this->totalscores];
            /*  **********  *************************/
              return $this->total_Ambassador;
        }
        public function invitation( User $user)
        {
            $this->introduced=($user->get_invitations->count());

            $this->totalIntroduced=$this->introduced*$this->setting->where('setting','score_introduced')->first()->value;
            $this->totalscores= $this->totalscores+$this->totalIntroduced;
            $this->total_Ambassador+=['totalIntroduced'=> $this->totalIntroduced];
//            $this->Product_purchase=$this->Product_purchase+($user->checkouts->where('status','=','1')->sum('price')/$this->setting->where('setting','score_product_purchase')->first()->value);


//            foreach ($user->get_invitations as $invites)
//            {
//                $this->Product_purchase+=($invites->checkouts->where('status','=','1')->sum('price'));
//
//                $this->totalscores= $this->totalscores+$this->Product_purchase;
////
////                $this->total_Ambassador+=['totalre_purchase'=>$this->totalpurchase];
////                $this->total_Ambassador+=['totalscores'=>$this->totalscores];
////                $this->total_allscore+= $this->ScoreAmbassador($invites)['totalscores'];
//
//                //$this->ScoreAmbassador($invites);
//            }



//            $this->totalpurchase=$this->totalpurchase+($this->Product_purchase/$this->setting->where('setting','score_product_purchase')->first()->value);

            session()->put('totalIntroduced',session('totalIntroduced')+$this->totalscores);

            return $this->totalscores  ;
        }
}
