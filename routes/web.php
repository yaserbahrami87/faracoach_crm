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

Route::get('/', 'HomeController@index');



//Route::middleware(['can:isUser','verified'])->prefix('panel')->group(function () {
Route::middleware(['can:isUser'])->prefix('panel')->group(function () {

    // ROUTE USER

    Route::get('/profile','UserController@profile');
    Route::patch('/profile/update/{user}','UserController@update');
    Route::get('/userAjax/{user}','UserController@introducedUserAjax');
    Route::get('/user/password','AdminController@changePasswordViewUser')->middleware('password.confirm');
    Route::patch('/user/updatePassword','UserController@updatePasswordUser');

    //messages
    Route::get('/messages/','MessageController@index');
    Route::get('/messages/show/{message}','MessageController@show');
    Route::get('/messages/new','MessageController@create');
    Route::post('/messages/send','MessageController@store');
    Route::post('/messages/reply','MessageController@reply');


    //Introduced
    Route::post('/introduced/introduced_verified','UserController@introducedVerified');
    Route::get('/introduced','UserController@listIntroducedUser');
    Route::get('/introduced/search','UserController@searchUsersIntroduced');
    Route::post('/introduced/add','UserController@addIntroducedUser');

    //Products
    Route::get('/products','AdminController@showProducts');

    //followup
    Route::get('/followup/{followup}','UserController@showFollowupIntroduced');
    Route::post('/followup/create','FollowupController@store_user');

    //Tel verify
    Route::get('/active/mobile/','VerifyController@verifyTelPanel');
    Route::post('/active/mobile/code','VerifyController@checkVerifyTelPanel');

    //Packages
    Route::get('/freepackages','AdminController@showFreePackages');

    //documents
    Route::get('/documents','DocumentController@indexUser');
    Route::get('/documents/{document}','DocumentController@showUser');

    //POSTS
    Route::resource('post','PostController');

    //comments
    Route::resource('comments','CommentController');


    //category post
    Route::resource('categoryposts','CategoryPostController');

    //teachers
    Route::get('/teachers','TeacherController@listTeachers');
    Route::get('/teacher/{teacher}','TeacherController@show');

    //coaches
    Route::patch('/coach/{coach}/newrequest','CoachController@newrequest');
    Route::patch('/coach/{coach}/updateCoach','CoachController@updateCoach');
    Route::get('/booking/report','CoachController@booking_report_byUser');
    Route::resource('coach','CoachController');


    //booking
    Route::get('/booking/accept','BookingController@acceptReserve');
    Route::get('/booking/accept_reserve_user','BookingController@accept_reserve_user');
    Route::resource('booking','BookingController');



    //coupon
    Route::resource('coupon','CouponController');

    //Reserves
    Route::patch('/reserve/{reserve}/update','ReserveController@result_coach');
    Route::get('/reserve/{reserve}','ReserveController@show');

    //feedback Coach
    Route::resource('feedbackcoach','FeedbackCoachingController');

    //integrity
    Route::resource('integrityTest','IntegrityTestController');

    //Download video webinar Integrity
    Route::get('/integrity/files',function()
    {
       return view('panelUser.integrity_webinarDownload');
    });

    //Gift Certificates
    Route::get('/gift/certificate',function()
    {
        return view('panelUser.gift_certificate');
    });

    //Landing Page
    Route::post('/landing/invitation/','landingController@invitaionStore');
    Route::get('/invitation','landingController@invitaionCreate');

});


Route::middleware('can:isEducation')->group(function () {

});



Route::middleware('can:isAdmin')->prefix('admin')->group(function () {
//Route::group(['middleware' => ['can:isEducation','can:isAdmin']], function() {

    // user
    //Route::get('/admin/panel/','AdminController@index')->name('panelAdmin');
    Route::get('/users','UserController@index');
    Route::get('/user/{user}','UserController@show');
    Route::patch('/profile/update/{user}','UserController@update');
    Route::patch('/user/{id}/changeType','UserController@changeType');



    Route::get('/users/search/','UserController@searchUsers');
    Route::get('/users/search/advance','UserController@advanceSearchUsers');
    Route::get('/add','UserController@showRegister');
    Route::post('/register','UserController@register');
    Route::get('/user/{user}/delete','UserController@destroy');
    Route::get('/users/category/','UserController@showCategoryUsersAdmin');
    Route::get('/users/categoryTags/','UserController@showCategoryTagsAdmin');
//    Route::get('/users/categorybyAdmin/','UserController@categorybyAdmin');
//    Route::get('/users/list_user_gettingknow','UserController@list_user_gettingknow');
    Route::get('/users/advancesearch','UserController@advancesearch');
//    Route::get('/users/export_excel','UserController@export_excel');


    Route::get('/user/{tel}/password','AdminController@changePasswordView');
    Route::patch('/user/{tel}/updatePassword','UserController@updatePassword');
    Route::get('/users/excel','UserController@createExcel');
    Route::post('/users/storeExcel','UserController@storeExcel');

    //  ROUTE SETTINGS
    Route::post('/settings/problemfollowup/store','ProblemfollowupController@store');
    Route::get('/settings/problemfollowup/delete/{problemfollowup}','ProblemfollowupController@destroy');
    Route::get('/settings/problemfollowup/edit/{problemfollowup}','ProblemfollowupController@edit');
    Route::patch('/settings/problemfollowup/update/{problemfollowup}','ProblemfollowupController@update');
    Route::get('/settings/','AdminController@showSettings');
    Route::get('/settings/problemfollowup/new',function()
    {
        return view('panelAdmin.insertProblemFollowup');
    });


    // *** Tags Setting
    Route::get('/settings/tags/new','TagController@create');
    Route::post('/settings/tags/store','TagController@store');
    Route::get('/settings/tags/delete/{tag}','TagController@destroy');
    Route::get('/settings/tags/edit/{tag}','TagController@edit');
    Route::patch('/settings/tags/update/{tag}','TagController@update');
    Route::get('/settings/settingtags/{data}','TagController@ajaxsettingstag');
    Route::patch('/settings/updatetags','TagController@updateAllTags');
    //*** Category Tags Settings
    Route::get('/settings/categorytags/new','CategoryTagController@index');
    Route::post('/settings/categorytags/store','CategoryTagController@store');
    Route::get('/settings/categorytags/edit/{categoryTag}','CategoryTagController@edit');
    Route::patch('/settings/categorytags/update/{categoryTag}','CategoryTagController@update');
    Route::get('/settings/categorytags/delete/{categoryTag}','CategoryTagController@destroy');
    Route::get('/settings/subcategorytags/{data}','CategoryTagController@ajaxsubcategory');

    //Route Messages
    Route::get('/messages/','MessageController@index');
    Route::get('/messages/show/{message}','MessageController@show');
    Route::get('/messages/new','MessageController@create');
    Route::post('/messages/send','MessageController@store');
    Route::post('/messages/reply','MessageController@reply');

    // Route Admin Followup
    Route::post('/followup/create','FollowupController@store');

    // File Manager
    Route::get('/filemanager',function()
    {
        return view('panelAdmin/fileManager');
    });

    //Route reports
    Route::get('/reports/',function()
    {
        return view('panelAdmin.reports');
    });

    //Teachers
    Route::resource('teachers','TeacherController');

    //coaches

    Route::get('/coach/{coach}/report','CoachController@coach_report');
    Route::get('/coach/reject','CoachController@coach_reject');
    Route::get('/coach/request','CoachController@coach_request');
    Route::resource('coach','CoachController');

    //Category Coaches
    Route::resource('category_coach','CategoryCoachController');

    //Courses
    Route::get('/courses/test','CourseController@course_test');
    Route::resource('courses','CourseController');

    //CourseType
    Route::resource('coursetype','CoursetypeController');

    //SMS
    Route::resource('sms','SmsController');
    Route::post('/sms/createajax','SmsController@createAjax');

    //Setting SMS
    Route::resource('settingsms','SettingsmsController');

    //score
    Route::resource('settingscore','SettingscoreController');

    //documents
    Route::resource('documents','DocumentController');

    //options
    Route::get('/settingreserve','OptionController@settingReserve');
    Route::patch('/settingreserve/update','OptionController@updateSettingReserve');
    Route::resource('options','OptionController');

    //booking
    Route::get('/booking/accept','BookingController@acceptReserve');
    Route::resource('booking','BookingController');

    //coupon
    Route::resource('coupon','CouponController');

    //reserve
    Route::get('/reserve/waiting','ReserveController@waiting');

    //feedback Coach
    Route::resource('feedbackcoach','FeedbackCoachingController');

    //type Coaches
    Route::resource('type_coach','TypeCoachController');

    //categorygettingknows
    Route::resource('category_gettingknow','CategoryGettingknowController');

    //Students
    Route::prefix('education/')->group(function ()
    {
        Route::prefix('students')->group(function () {
            Route::get('search','StudentController@search');
            Route::get('advancesearch','StudentController@advancesearch');
        });

        Route::resource('students', 'StudentController');
    });


    //Landing Page
    Route::prefix('invitation/')->group(function ()
    {
//        Route::prefix('students')->group(function () {
//            Route::get('search','StudentController@search');
//            Route::get('advancesearch','StudentController@advancesearch');
//        });

        Route::get('/index','landingController@invitationIndex');
    });
});



Auth::routes(['verify'=>true]);


Route::post('/crm/user/insert','UserController@store');

Route::get('/signup crm','BaseController@signupForm');
Route::get('/check/user/{id}','UserController@checkUserAjax');

Route::get('/panel','AdminController@index')->name('panel');
Route::get('/panel/state/{state}','BaseController@citiesAjax');
Route::get('/active/mobile/{tel}', 'VerifyController@store');
Route::get('/active/mobile/verify/{code}','VerifyController@checkCode');
Route::get('/loginSMS','AdminController@loginSMS');
Route::post('/panel/storeCodewithoutPass','VerifyController@storeCodewithoutPass');
Route::post('/panel/checkCodewithoutPass','VerifyController@checkCodewithoutPass');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Verify Tel Landings
Route::get('/verify/active/tel', 'VerifyController@store_landings');
Route::get('/verify/active/tel/check/{code}','VerifyController@checkCode_landings');

// Landing Page
Route::get('/landingPage','landingController@index');

Route::post('/landing/store','landingController@store_landing_gift');
Route::get('/showPackageDownload', 'landingController@showPackageDownload')->name('freePackageLanding');
Route::get('/password/sendcode','VerifyController@sendResetCode');
Route::post('/password/reset/update','VerifyController@checkResetCode');



Route::get('/register2',function()
{
    return view('register_landingPage');
});

// Landing Register
Route::post('/register/land','UserController@register_landing');
//Route::get('/test2',function()
//{
//    return view('landTamamiat_return');
//});

Route::resource('landPage','LandPageController');



//checkout
Route::get('/checkout/callback','CheckoutController@callback');
Route::resource('checkout','CheckoutController');


//comments
Route::post('/post/addcomment/{post}','CommentController@store');

//gift
Route::get('/gift',function()
{
    return view('gift');
});



//integrity test
Route::get('/integrity_test',function()
{
    return view('integrityTest');
});


//booking
Route::get('/booking/createajax','BookingController@createAjax');
Route::get('/booking/showformreserve','BookingController@showFormReserve');
Route::post('/booking/mohasebe','ReserveController@mohasebe');
Route::resource('booking','BookingController');




//reserve
Route::post('/reserve/insert', 'ReserveController@insert');
Route::resource('reserve','ReserveController');



//coaches
Route::get('/coaches/all','CoachController@viewAllCoaches');
Route::get('/coach/{coach}','CoachController@show');

//Cart
Route::get('/cart','ReserveController@showCart');

//Category GettingKnow
Route::get('/showListChildGettingKnow/{id}','CategoryGettingknowController@showListChild');

//Coupon
Route::post('/coupon/check','CouponController@check');
Route::post('/coupon/checkoff','CouponController@checkOff');

//TWEETS
Route::resource('tweets','TweetController');



//LiKE
Route::resource('like','LikeController');

Route::get('/ravanshenasi',function()
{
    return view('landeRavanshenasi');
});

Route::get('/integrity','LandPageController@create');

Route::get('/exportexcel','UserController@export_excel');
// تبدیل نحوه شانایی به کد
Route::get('/test','UserController@test');


//تست
Route::post('/tamamiat_send','AdminController@tamamiat_test');



//blog
Route::get('/{username}','PostController@blogHomePage');
Route::get('/{username}/post/{post}','PostController@show');
Route::get('/{username}/category/{category}','PostController@categoryBlog');
Route::get('/blogs/newposts','PostController@newPosts');

