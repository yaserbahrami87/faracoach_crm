<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/crm/user/insert','UserController@store');

Route::get('/signup crm',function () {
    return view('signup');
});

Route::get('/panel/','UserController@panel')->name('panel')->middleware('auth');
Route::get('/panel/profile','UserController@profile')->middleware('auth');

Route::patch('/panel/profile/update/{user}','UserController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
