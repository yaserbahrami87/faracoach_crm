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
Route::post('/signupAjax', 'UserController@signupAjax');



//Route::middleware(['can:isUser','verified'])->prefix('panel')->group(function () {
Route::middleware(['can:isUser'])->prefix('panel')->group(function () {

    // ROUTE USER

    Route::get('/profile','UserController@profile');
    Route::get('/user/contacts','UserController@contacts');
    Route::get('/user/introduction','UserController@introduction');
    Route::get('/user/contract','UserController@contract');
    Route::patch('/profile/update/{user}','UserController@update');
    Route::get('/userAjax/{user}','UserController@introducedUserAjax');
    Route::get('/user/password','AdminController@changePasswordViewUser')->middleware('password.confirm');
    Route::patch('/user/updatePassword','UserController@updatePasswordUser');

    //messages
//    Route::get('/messages/','MessageController@index');
//    Route::get('/messages/show/{message}','MessageController@show');
//    Route::get('/messages/new','MessageController@create');
//    Route::post('/messages/send','MessageController@store');
    Route::post('/message/reply','MessageController@reply');
    Route::post('/message/send','MessageController@sendMessage');
    Route::resource('message','MessageController');



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
    Route::get('/coach/profile','CoachController@profile_coach');
    Route::get('/booking/report','CoachController@booking_report_byUser');
    Route::resource('coach','CoachController');


    //booking
    Route::get('/booking/accept','BookingController@acceptReserve');
    Route::get('/booking/accept_reserve_user','BookingController@accept_reserve_user');
    Route::resource('booking','BookingController');

    //Homework
    Route::resource('homework','HomeworkController');



    //coupon
    Route::resource('coupon','CouponController');

    //Reserves
    Route::patch('/reserve/{reserve}/update','ReserveController@result_coach');
    Route::get('/reserve/{reserve}','ReserveController@show');
    Route::PATCH('/reserve/{reserve}','ReserveController@update');

    //feedback Coach
    Route::resource('feedbackcoach','FeedbackCoachingController');

    //integrity
    Route::resource('integrityTest','IntegrityTestController');

    //effectiveListenings
    Route::resource('effectiveListenings','EffectivelisteningController');

    // communication skill
    Route::get('/communication_skill','AssessmentController@communicationSkill_create');

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


    //Psychological
    Route::get('/psychological/create','PsychologicalController@create');
    Route::post('/psychological','PsychologicalController@store');


    //Event Reserves
    Route::resource('eventreserve','EventreserveController');

    //Order
    Route::post('/order','OrderController@store');
    Route::post('/order/aghsat','OrderController@storeAghsat');



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
//    Route::get('/messages/','MessageController@index');
//    Route::get('/messages/show/{message}','MessageController@show');
//    Route::get('/messages/new','MessageController@create');
//    Route::post('/messages/send','MessageController@store');
    Route::post('/message/reply','MessageController@reply');
    Route::post('/message/send','MessageController@sendMessage');
    Route::resource('message','MessageController');

    // Route Admin Followup
    Route::post('/followup/create','FollowupController@store');

    // File Manager
    Route::get('/filemanager',function()
    {
        return view('admin/fileManager');
    });

    //Route reports
    Route::get('/reports/',function()
    {
        return view('panelAdmin.reports');
    });

    //Teachers
    Route::resource('teachers','TeacherController');

    //coaches
    Route::get('/booking/{coach}/report','BookingController@coach_report');
    Route::get('/coach/reject','CoachController@coach_reject');
    Route::get('/coach/request','CoachController@coach_request');
    Route::resource('coach','CoachController');

    //Category Coaches
    Route::resource('category_coach','CategoryCoachController');

    //Courses
    Route::get('/courses/test','CourseController@course_test');
    Route::get('/courses/{course}/students','CourseController@showStudents');
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

    //Checkout
    route::resource('/checkout','CheckoutController');

    // Page Builder
    Route::get('/pagebuilder',function()
    {
        return view('panelAdmin.pageBuilder');
    });


    //Students
    Route::prefix('education/')->group(function ()
    {
        Route::prefix('students')->group(function () {
            Route::get('search','StudentController@search');
            Route::get('advancesearch','StudentController@advancesearch');
        });

        Route::resource('students', 'StudentController');
    });

    //psychological
    Route::get('/psychological/export/{psychological}','PsychologicalController@export_excel');
    Route::resource('psychological','PsychologicalController');


    //EVENTS
    Route::get('/event/isfahan/list','landingController@isfahanList');

    //Events
    Route::Patch('/event/{event}/updateStatus','EventController@updateStatus');
    Route::get('/event/all','EventController@eventsListAdmin');
    Route::get('/event/{event}/users','EventController@usersEvent');
    Route::get('/event/{event}/export','EventController@exportExcel');
    Route::resource('event','EventController');
});



Auth::routes(['verify'=>true]);


Route::post('/crm/user/insert','UserController@store');

Route::get('/signup crm','BaseController@signupForm');
Route::get('/check/user/{tel}','UserController@checkUserAjax');

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

//landing Booking coaching
Route::get('/what-is-coaching/', 'landingController@bookOffCreate');
Route::post('/what-is-coaching/bookOffStore', 'landingController@bookOffStore');

//Verify Codes
Route::post('/verify', 'VerifyController@verifyCreate');
Route::post('/verifyCode', 'VerifyController@verifyStore');


Route::get('/register2',function()
{
    return view('register_landingPage');
});

// Landing Register
Route::post('/register/land','UserController@register_landing');
Route::resource('landPage','LandPageController');



//checkout
Route::get('/checkout/callback','CheckoutController@callback');
Route::resource('checkout','CheckoutController');



//gift
Route::get('/gift',function()
{
    return view('gift');
});



//integrity test
Route::get('/integrity_test',function()
{
    return view('panelUser.integrityTest');
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
Route::post('/cart','CartController@store');
Route::get('/cart/all','CartController@index');
Route::post('/cart/payment','CartController@choosePaymant');
Route::get('/cart/{cart}','CartController@destroy');
Route::get('/cart','ReserveController@showCart');
Route::post('/cart/mohasebeAghsat','CartController@mohasebeAghsat');


//Category GettingKnow
Route::get('/showListChildGettingKnow/{id}','CategoryGettingknowController@showListChild');

//Coupon
Route::post('/coupon/check','CouponController@check');
Route::post('/coupon/checkoff','CouponController@checkOff');
Route::post('/coupon/checkCoupon','CouponController@checkCoupon');

//TWEETS
Route::resource('tweets','TweetController');

//Course
Route::get('/courses','CourseController@showCourses');
Route::get('/courses/{course}','CourseController@show');


//LiKE
Route::resource('like','LikeController');


//RAVANSHENASI
Route::get('/ravanshenasi',function()
{
    return view('landeRavanshenasi');
});

Route::get('/integrity','LandPageController@create');


//landing Isfahan
//Route::get('/events/isfahan', 'landingController@isfahanCreate');
//Route::post('/events/isfahan/store', 'landingController@isfahanStore');
//Route::get('/events/isfahan/exportexcel', 'landingController@isfahanExport');


//Pasargad Bimeh
Route::prefix('club')->group(function ()
{

        Route::get('/home',function()
        {
            return view('pasargadBimeh.club');
        });

        Route::get('bimeh',function()
        {
            return view('pasargadBimeh.bimeh');
        });


});

Route::get('/exportexcel','UserController@export_excel');

Route::resource('event','EventController');

//Route::get('/test','FollowupController@test');
Route::get('/test','UserController@test');

//blog
Route::get('/{username}','PostController@blogHomePage');
Route::get('/{username}/post/{post}','PostController@show');
Route::get('/{username}/category/{category}','PostController@categoryBlog');
Route::get('/blogs/newposts','PostController@newPosts');

