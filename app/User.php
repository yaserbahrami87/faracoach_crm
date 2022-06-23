<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','fname', 'lname', 'codemelli','sex','tel','shenasname','datebirth','father','born','married','type','education','reshteh','job','organization','jobside','state','city','address','personal_image','shenasnameh_image','cartmelli_image','education_image','email','password','resource','detailsresource','introduced','gettingknow','gettingknow_child','followby_id','tel_verified','last_login_at','insert_user_id','telegram','instagram','linkedin','aboutme','status_coach'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function getRouteKeyName()
//    {
//        return 'tel';
//    }

        protected $rules = [
            'email'     => 'sometimes|required|email|unique:users',
            'tel'       => 'sometimes|required|iran_mobile|unique:users',
            'codemelli' => 'sometimes|required|melli_code|unique:users',
        ];



        public function followups()
        {
            return $this->hasMany('App\followup');
        }

        public function last_followupUser()
        {
            return $this->belongsTo('App\followup','user_id','id')->where('flag','=',1);
        }


        public function get_followby_expert()
        {
            return $this->hasMany('App\User','followby_expert','id');
        }

        public function categoryGettingKnow()
        {
            return $this->belongsTo('App\category_gettingknow','gettingknow','id');
        }

        public function get_insertuserInfo()
        {
            return $this->belongsTo('App\User','insert_user_id','id');
        }

        public function checkouts()
        {
            return $this->hasMany('App\checkout','user_id','id');
        }

        public function lastLoginUser()
        {
            return User::orderby('last_login_at','desc')
                    ->limit(30)
                    ->get();
        }

        public function reserves()
        {
            return $this->hasMany('App\reserve','user_id','id');
        }

        public function notifications()
        {
            return $this->hasMany('App\notification');
        }

        public function coach()
        {
            return $this->hasOne('App\coach','user_id','id');
        }

        public function faktors()
        {
            return $this->hasMany('App\faktor','user_id','id');
        }

        public function reserveEvent()
        {
            return $this->hasMany('App\eventreserve','user_id','id');
        }
        public function userType($status)
        {
            switch($status)
            {
                case "-3":return "مارکتینگ 3";
                    break;
                case "-2":return "مارکتینگ 2";
                    break;
                case "-1":return "مارکتینگ 1";
                    break;
                case "1": return "پیگیری نشده";
                    break;
                case "2":return "مدیر";
                    break;
                case "3":return "آموزش";
                    break;
                case "4":return "کلینیک";
                    break;
                case "11": return "تور پیگیری";
                    break;
                case "12":return "انصراف";
                    break;
                case "13":return "در انتظار تصمیم";
                    break;
                case "14":return "عدم پاسخگویی";
                    break;
                case "20":return "مشتری";
                    break;
                case "30":return "جلسات";
                    break;
                case "40":return "رویداد";
                    break;

                default:return "";
            }
        }

        public function carts()
        {
            return $this->hasMany('App\cart','user_id','id');
        }

        public function students()
        {
            return $this->hasMany('App\student');
        }

        public function wallet()
        {
            return $this->belongsTo('App\wallet');
        }



}
