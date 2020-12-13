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
            'email'         => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'tel'           => ['required','numeric','unique:users','regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'tel_verified'  => ['required','boolean']

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
        return User::create([
            'fname'         => $data['fname'],
            'lname'         => $data['lname'],
            'email'         => $data['email'],
            'tel'           =>$data['tel'],
            'tel_verified'  =>$data['tel_verified'],
            'password'      => Hash::make($data['password']),
        ]);
    }
}
