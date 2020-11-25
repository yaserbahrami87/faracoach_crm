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
    Route::get('/admin/panel/','AdminController@index')->name('panelAdmin');
    Route::get('/admin/users','UserController@index');
    Route::get('/admin/user/{user}','UserController@show');
    Route::patch('/admin/profile/update/{user}','UserController@update');

    //Route::post('/admin/users/search/','AdminController@searchUsers');
    Route::get('/admin/users/search/','AdminController@searchUsers');

    Route::get('/admin/users/category/','AdminController@showCategoryUsers');
    Route::get('/admin/settings/','AdminController@showSettings');
    Route::get('/admin/settings/problemfollowup/new',function()
    {
        return view('panelAdmin.insertProblemFollowup');
    });
    //  ROUTE SETTINGS
    Route::post('/admin/settings/problemfollowup/store','ProblemfollowupController@store');
    Route::get('/admin/settings/problemfollowup/delete/{problemfollowup}','ProblemfollowupController@destroy');
    Route::get('/admin/settings/problemfollowup/edit/{problemfollowup}','ProblemfollowupController@edit');
    Route::patch('/admin/settings/problemfollowup/update/{problemfollowup}','ProblemfollowupController@update');


    //Route Messages
    Route::get('/admin/messages/','MessageController@index');
    Route::get('/admin/messages/show/{message}','MessageController@show');
    Route::get('/admin/messages/new','MessageController@create');
    Route::post('/admin/messages/send','MessageController@store');
    Route::post('/admin/messages/reply','MessageController@reply');

    // Route Admin Followup
    Route::post('/admin/followup/create','FollowupController@store');

    // File Manager
    Route::get('/admin/filemanager',function()
    {
        return view('panelAdmin/fileManager');
    });
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Landing Page
Route::get('/landingPage/','landingController@index');
Route::post('/landing/store','landingController@store');
Route::get('/showPackageDownload', 'landingController@showPackageDownload')->name('freePackageLanding');
