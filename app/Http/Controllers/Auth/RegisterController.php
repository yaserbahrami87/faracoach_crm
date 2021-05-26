<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/panel";//$redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname'         => ['persian_alpha','required', 'string', 'max:30'],
            'lname'         => ['persian_alpha','required', 'string', 'max:30'],
            'sex'           => ['required','boolean'],
            'email'         => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'tel'           => ['required','unique:users','iran_mobile'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'tel_verified'  => ['required','boolean'],
            'introduced'    => ['nullable','numeric'],
            'gettingknow'   => ['nullable','persian_alpha'],
            'organization'  => ['nullable','persian_alpha'],
            'jobside'       => ['nullable','persian_alpha']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(!isset($data['gettingknow']))
        {
            $data['gettingknow']=NULL;
        }

        if(!isset($data['introduced']))
        {
            $data['introduced']=NULL;
        }

        if(!isset($data['organization']))
        {
            $data['organization']=NULL;
        }

        if(!isset($data['jobside']))
        {
            $data['jobside']=NULL;
        }

        $data['resource']=NULL;
        $data['detailsresource']=NULL;

        return User::create([
            'fname'             => $data['fname'],
            'lname'             => $data['lname'],
            'sex'               =>$data['sex'],
            'email'             => $data['email'],
            'tel'               =>$data['tel'],
            'tel_verified'      =>$data['tel_verified'],
            'password'          => Hash::make($data['password']),
            'introduced'        =>$data['introduced'],
            'gettingknow'       =>$data['gettingknow'],
            'organization'      =>$data['organization'],
            'jobside'           =>$data['jobside'],
            'resource'          =>$data['resource'],
            'detailsresource'   =>$data['detailsresource']
        ]);
    }
}
