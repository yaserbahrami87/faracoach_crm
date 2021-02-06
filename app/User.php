<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'codemelli','sex','tel','shenasname','datebirth','father','born','married','education','reshteh','job','organization','jobside','state','city','address','personal_image','shenasnameh_image','cartmelli_image','education_image','email','password','resource','detailsresource','introduced','gettingknow','followby_id','tel_verified','last_login_at','insert_user_id'
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

}
