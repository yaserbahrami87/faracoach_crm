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

Route::middleware('auth')->group(function () {

    // ROUTE USER
    Route::get('/panel/','UserController@panel')->name('panel');
    Route::get('/panel/profile','UserController@profile');
    Route::patch('/panel/profile/update/{user}','UserController@update');
});



Route::middleware('can:isAdmin')->group(function () {
    Route::get('/admin/panel/','UserController@create')->name('panelAdmin');
    Route::get('/admin/users','UserController@index');
    Route::get('/admin/user/{user}','UserController@show');
    Route::patch('/admin/profile/update/{user}','UserController@update');
    // Route Admin Followup
    Route::post('/admin/followup/create/','FollowupController@store');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
