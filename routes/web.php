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

Route::get('/signup crm','BaseController@signupForm');


Route::get('/panel','AdminController@index')->name('panel');
Route::get('/panel/state/{state}','BaseController@citiesAjax');
Route::get('/active/mobile/{tel}', 'VerifyController@store');
Route::get('/active/mobile/verify/{code}','VerifyController@checkCode');


Route::middleware('can:isUser')->group(function () {

    // ROUTE USER

    Route::get('/panel/profile','UserController@profile');
    Route::patch('/panel/profile/update/{user}','UserController@update');
    Route::get('/panel/userAjax/{user}','UserController@introducedUserAjax');

    //messages
    Route::get('/panel/messages/','MessageController@index');
    Route::get('/panel/messages/show/{message}','MessageController@show');
    Route::get('/panel/messages/new','MessageController@create');
    Route::post('/panel/messages/send','MessageController@store');
    Route::post('/panel/messages/reply','MessageController@reply');


    //Introduced
    Route::get('/panel/introduced','UserController@listIntroducedUser');
    Route::get('/panel/introduced/search','UserController@searchUsersIntroduced');
    Route::post('/panel/introduced/add','UserController@addIntroducedUser');

    //Products
    Route::get('/panel/products','AdminController@showProducts');

    //followup
    Route::get('/panel/followup/{followup}','UserController@showFollowupIntroduced');
    Route::post('/panel/followup/create','FollowupController@store');
});




Route::middleware('can:isAdmin')->group(function () {
    //Route::get('/admin/panel/','AdminController@index')->name('panelAdmin');
    Route::get('/admin/users','UserController@index');
    Route::get('/admin/user/{user}','UserController@show');
    Route::patch('/admin/profile/update/{user}','UserController@update');

    Route::get('/admin/users/search/','UserController@searchUsers');

    Route::get('/admin/users/category/','UserController@showCategoryUsersAdmin');
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
Route::get('/landingPage','landingController@index');
Route::post('/landing/store','landingController@store');
Route::get('/showPackageDownload', 'landingController@showPackageDownload')->name('freePackageLanding');

