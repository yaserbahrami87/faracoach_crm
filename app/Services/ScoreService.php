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
        public function invitation( User $user)
        {
            session()->put('totalscore',0);
            /*  **********introduced*************************/

                $this->introduced=($user->get_invitations->count());
                $this->totalIntroduced=$this->introduced*$this->setting->where('setting','score_introduced')->first()->value;
                $this->introducedscore+=+$this->totalIntroduced;
                $this->total_Ambassador+=['totalIntroduced'=> $this->introducedscore];

            /*  ********** Product_purchase *************************/

                $this->Product_purchase+=($user->checkouts->where('status','=','1')->sum('price')/$this->setting->where('setting','score_product_purchase')->first()->value);
                $this->Product_purchase+=($user->faktors->where('status','=',1)->sum('fi')/$this->setting->where('setting','score_product_purchase')->first()->value);
                $this->totalpurchase+=$this->Product_purchase;
                $this->total_Ambassador+=['Product_purchase'=>$this->totalpurchase];

            /*  ********** Re Entry *************************/

                if(!is_null($user->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()))
                {
                    $this->re_entry=($user->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()->log_date);
                    $now = Carbon::now();
                    $month = $now->format('m');
                    if(substr($this->re_entry,5,2)==$month)
                    {
                        $this->totalre_entry+=$this->setting->where('setting','score_re_entry')->first()->value;
                        $this->totalscores+=$this->totalre_entry;
                        $this->total_Ambassador+=['totalre_entry'=>$this->totalre_entry];
                        /* dd($this->total);*/
                    }
                }
                else
                {
                    $this->total_Ambassador+=['totalre_entry'=>0];
                }

            /*  ********** Re introduced *************************/

            foreach ($user->get_invitations as $invites)
            {
                /*  **********introduced*************************/
                $this->subintroduced=($invites->get_invitations->count());
                $this->subtotalIntroduced=$this->subintroduced*$this->setting->where('setting','score_introduced')->first()->value;
                $this->subtotalscores+=$this->subtotalIntroduced;
                $this->subtotal_Ambassador+=['subtotalIntroduced'=> $this->subtotalIntroduced];
                /*  ********** Product_purchase *************************/
                $this->subProduct_purchase+=($invites->checkouts->where('status','=','1')->sum('price')/$this->setting->where('setting','score_product_purchase')->first()->value);
                $this->subProduct_purchase+=($invites->faktors->where('status','=',1)->sum('fi')/$this->setting->where('setting','score_product_purchase')->first()->value);
                $this->subtotalpurchase+=$this->subtotalpurchase;
                $this->subtotalscores+=$this->subtotalpurchase;
                $this->subtotal_Ambassador+=['subProduct_purchase'=>$this->subtotalpurchase];
                /*  ********** Re Entry *************************/
                if(!is_null($invites->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()))
                {
                    $this->subre_entry=($invites->logs()->where('log_type','like','login')->orderBy('log_date','desc')->first()->log_date);
                    $now = Carbon::now();
                    $month = $now->format('m');
                    if(substr($this->subre_entry,5,2)==$month)
                    {
                        $this->subtotalre_entry+=$this->setting->where('setting','score_re_entry')->first()->value;
                        $this->subtotalscores+=$this->subtotalre_entry;
                        $this->subtotal_Ambassador+=['subtotalre_entry'=>$this->subtotalre_entry];
                        /* dd($this->total);*/
                    }
                }
                else
                {
                    $this->subtotal_Ambassador+=['subtotalre_entry'=>0];
                }
                $this->subtotal_allscore+=$this->subtotalscores;
            }


                $this->total_re_introducedscore=$this->subtotal_allscore/10;
                $this->total_Ambassador+=['total_re_introducedscore'=>$this->total_re_introducedscore];
                $this->totalscores+=$this->totalre_entry+$this->totalIntroduced+$this->totalpurchase+$this->total_re_introducedscore;

                $this->total_Ambassador+=['totalscores'=>$this->totalscores];

            session()->put('totalscoreUser',session('totalscoreUser')+$this->totalscores);
            return $this->total_Ambassador;
        }
}
