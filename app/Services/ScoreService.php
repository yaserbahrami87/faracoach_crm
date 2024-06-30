<?php

namespace App\Services;


use App\Score;
use App\Setting;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ScoreService
{
//    public static function Score(User $user)
//    {
//        $setting = Setting::where('setting', 'like', '%score_%')
//            ->get();
//        $introduced = 0;
//        $total_introduced = 0;
//        $re_entry = 0;
//        $total = 0;
//        $total_Ambassador = [];
//
//
//        /*  **********introduced*************************/
//        $introduced = ($user->get_invitations->count());
//        $total_introduced = $introduced * $setting->where('setting', 'score_introduced')->first()->value;
//        $total_Ambassador += ['totalIntroduced' => $total_introduced];
//
//
//        foreach ($user->get_invitations as $invite) {
////       *****************  re_entrty **********************
//            $total += self::subscore($invite);
//        }
//        dd($total_Ambassador);
//        $scores=Score::updateOrInsert(
//            ['user_id'=>$user->id],
//            ['score_re_entry'=>$total_Ambassador]
//        );
//        $total_Ambassador += ['Score_final' => $total + $total_introduced];
//        $total_Ambassador += ['introduced' => $total_introduced];
//        $total_Ambassador += ['sub_total' => $total];
//        return $total_Ambassador;
//    }

    public static function re_entry(user $user)
    {
        $total_re_entry = 0;
        $total_subscore = 0;
        $setting = Setting::where('setting', 'like', '%score_%')
            ->get();
        if ($user->logs()->where('log_type', 'like', 'login')->count() != 0) {
            $re_entry = $user->logs()
                ->selectRaw('log_date, user_id, log_type')
                ->groupByRaw('LEFT(log_date, 7), log_type, user_id')
                ->having('log_type', '=', 'login')
                ->count();
            $total_re_entry = $re_entry * $setting->where('setting', 'score_re_entry')->first()->value;
        } else {
            $re_entry = 0;
        }
        return $total_re_entry;
    }
    public static function purchase(user $user)
    {
        $product_purchase = 0;
        $total_purchase = 0;
        $total_subscore = 0;
        $setting = Setting::where('setting', 'like', '%score_%')
            ->get();
        $product_purchase += ($user->checkouts->where('status', '=', '1')->sum('price') / $setting->where('setting', 'score_product_purchase')->first()->value);
        $product_purchase += ($user->faktors->where('status', '=', 1)->sum('fi') / $setting->where('setting', 'score_product_purchase')->first()->value);
        $total_purchase += $product_purchase;

        return $total_purchase;
    }
    public static function new_score(User $user)
    {

        $setting = Setting::where('setting', 'like', '%score_%')
            ->get();
        $total = 0;
        $purchase=0;
        $introduced = 0;
        $introduced = ($user->get_invitations->count());
        $total_introduced = $introduced * $setting->where('setting', 'score_introduced')->first()->value;
        foreach ($user->get_invitations as $invite) {
            $total += self::re_entry($invite);
        }
        foreach ($user->get_invitations as $invite) {
            $purchase += self::purchase($invite);
        }
        $scores=Score::updateOrInsert(
            ['user_id'=>$user->id],
            ['score_introduced'=>$total_introduced,'score_re_entry'=>$total,'score_purchase'=>$purchase]
        );
    }

}
