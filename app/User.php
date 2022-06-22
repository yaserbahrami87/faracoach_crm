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

//        public function todayFollowup($dateNow)
//        {
//            return $this->belongsTo('App\followup','user_id','id')
//                            ->where('flag','=',1)
//                            ->where('nextfollowup_date_fa','=',$dateNow);
//
//
//        }

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
        public function userType()
        {

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
