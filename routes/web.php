<?php

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
    return view('test');
});

Auth::routes(['verify' => true]);
Route::get('accept', function () {
    return 'Your are now in team.';
})->name('accept');
Route::get('acceptnot', function () {
    return 'sorry you are leate team member are all rady selected.';
})->name('acceptnot');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/logout', 'Auth\LoginController@adminlogout')->name('admin.logout');

Route::prefix('admin')->middleware('auth')->as('admin.')->group(function() {

	Route::get('/', 'Admin\AdminController@index')->name('admin');
	Route::get('/logout', 'Auth\LoginController@adminlogout')->name('logout');

	Route::get('/Paymentdetails', 'Admin\AdminController@Paymentdetails')->name('Paymentdetails');


	Route::resource('/collegeadmin', 'Admin\AddcollegeadminController');
	Route::resource('/student', 'Admin\StudentController');
	// Route::resource('/eventcodinator', 'Admin\EventcodinatorController');
	// Route::get('/eventcodinator/display', 'Admin\EventcodinatorController@display', ['as'=>'eventcodinator'])->name('display');	

	// Route::prefix('collegeadmin')->as('collegeadmin.')->group(function() {
	// 	Route::resource('/', 'Admin\AddcollegeadminController');
	// 	Route::get('/edit1/{id}', 'Admin\AddcollegeadminController@edit1')->name('edit1');
	// 	Route::put('/update1/{id}', 'Admin\EventController@update1')->name('update1');
	// 	//Route::delete('/destroy1/{id}', 'Admin\EventController@destroy1')->name('destroy1');
	// });

	Route::prefix('event')->as('event.')->group(function() {

		Route::resource('/', 'Admin\EventController');
		Route::get('/display', 'Admin\EventController@show')->name('display');
		Route::get('/edit1/{id}', 'Admin\EventController@edit1')->name('edit1');
		Route::put('/update1/{id}', 'Admin\EventController@update1')->name('update1');
		Route::delete('/destroy1/{id}', 'Admin\EventController@destroy1')->name('destroy1');
		Route::get('/participants', 'Admin\EventController@participants')->name('participants');
		Route::get('/eventditail/{id}', 'Admin\EventController@eventditail')->name('eventditail');
		Route::get('/winner', 'Admin\EventController@winner')->name('winner');
		Route::get('/teamdetail/{event_id}/{team_id}', 'Admin\EventController@teamdetail')->name('teamdetail');

	});

	Route::prefix('eventcodinator')->as('eventcodinator.')->group(function() {

		Route::resource('/', 'Admin\EventcodinatorController');
		Route::get('/display', 'Admin\EventcodinatorController@display')->name('display');
		Route::get('/show1/{id}', 'Admin\EventcodinatorController@show1')->name('show1');
		Route::get('/edit1/{id}', 'Admin\EventcodinatorController@edit1')->name('edit1');
		Route::put('/update1/{id}', 'Admin\EventcodinatorController@update1')->name('update1');
		Route::delete('/destroy1/{id}', 'Admin\EventcodinatorController@destroy1')->name('destroy1');
	});

	// Route::prefix('student')->as('student.')->group(function() {

	// 	Route::resource('/student', 'Admin\StudentController');
	// 	Route::get('/edit/{id}', 'Admin\StudentController@edit')->name('edit');
	// 	Route::put('/update/{id}', 'Admin\StudentController@update')->name('update');
	//Route::delete('/destroy/{id}','Admin\StudentController@destroy')->name('destroy');
	// });

});


Route::prefix('collegeadmin')->as('collegeadmin.')->group(function() {

	Route::get('/login', 'Auth\Collegeadmin\CollegeadminLoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth\Collegeadmin\CollegeadminLoginController@login')->name('login.submit');
	Route::get('/', 'Collegeadmin\CollegeadminController@index')->name('dashbord');
	Route::get('/logout', 'Auth\Collegeadmin\CollegeadminLoginController@logout')->name('logout');

	//password reset router
	Route::post('/password/email', 'Auth\Collegeadmin\CollegeadminForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('/password/reset', 'Auth\Collegeadmin\CollegeadminForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('/password/reset', 'Auth\Collegeadmin\CollegeadminResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\Collegeadmin\CollegeadminResetPasswordController@showResetForm')->name('password.reset');

	Route::prefix('eventcodinator')->middleware('auth:collegeadmin')->as('eventcodinator.')->group(function() {

		Route::resource('/', 'Collegeadmin\EventcodinatorController');
		Route::get('/display', 'Collegeadmin\EventcodinatorController@display')->name('display');
		Route::get('/show/{id}', 'Collegeadmin\EventcodinatorController@show')->name('show');
		Route::get('/edit/{id}', 'Collegeadmin\EventcodinatorController@edit')->name('edit');
		Route::put('/update/{id}', 'Collegeadmin\EventcodinatorController@update')->name('update');
		Route::delete('/destroy/{id}', 'Collegeadmin\EventcodinatorController@destroy')->name('destroy');
	});

	Route::resource('/student', 'Collegeadmin\StudentController')->middleware('auth:collegeadmin');

	Route::prefix('event')->middleware('auth:collegeadmin')->as('event.')->group(function() {

		Route::resource('/', 'Collegeadmin\EventController');
		Route::get('/display', 'Collegeadmin\EventController@show')->name('display');
		Route::get('/edit/{id}', 'Collegeadmin\EventController@edit1')->name('edit');
		Route::put('/update/{id}', 'Collegeadmin\EventController@update1')->name('update');
		Route::delete('/destroy/{id}', 'Collegeadmin\EventController@destroy1')->name('destroy');
		// Route::get('/publish/{id}', 'Collegeadmin\EventController@publish')->name('publish');
		Route::get('/participants', 'Collegeadmin\EventController@participants')->name('participants');
		Route::get('/eventditail/{id}', 'Collegeadmin\EventController@eventditail')->name('eventditail');
		Route::get('/winner', 'Collegeadmin\EventController@winner')->name('winner');
		Route::get('/teamdetail/{event_id}/{team_id}', 'Collegeadmin\EventController@teamdetail')->name('teamdetail');
	});

	Route::get('/Paymentdetails', 'Collegeadmin\CollegeadminController@Paymentdetails')->name('Paymentdetails');

});

Route::prefix('hod')->group(function() {

	Route::get('/login', 'Auth\Hod\HodLoginController@showLoginForm')->name('hod.login');
	Route::post('/login', 'Auth\Hod\HodLoginController@login')->name('hod.login.submit');
	Route::get('/', 'Hod\HodController@index')->name('hod.dashbord');
	Route::get('/logout', 'Auth\Hod\HodLoginController@logout')->name('hod.logout');

	// //password reset router
	Route::post('/password/email', 'Auth\Hod\HodForgotPasswordController@sendResetLinkEmail')->name('hod.password.email');
	Route::get('/password/reset', 'Auth\Hod\HodForgotPasswordController@showLinkRequestForm')->name('hod.password.request');
	Route::post('/password/reset', 'Auth\Hod\HodResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\Hod\HodResetPasswordController@showResetForm')->name('hod.password.reset');
});

Route::prefix('eventcodinator')->as('eventcodinator.')->group(function() {

	Route::get('/login', 'Auth\Eventcodinator\EventcodinatorLoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth\Eventcodinator\EventcodinatorLoginController@login')->name('login.submit');
	Route::get('/', 'Eventcodinator\EventcodinatorController@index')->name('dashbord');
	Route::get('/logout', 'Auth\Eventcodinator\EventcodinatorLoginController@logout')->name('logout');

	//password reset router
	Route::post('/password/email', 'Auth\Eventcodinator\EventcodinatorForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('/password/reset', 'Auth\Eventcodinator\EventcodinatorForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('/password/reset', 'Auth\Eventcodinator\EventcodinatorResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\Eventcodinator\EventcodinatorResetPasswordController@showResetForm')->name('password.reset');

	Route::get('/present', 'Eventcodinator\EventcodinatorController@present')->name('present');
	Route::get('/reset', 'Eventcodinator\EventcodinatorController@reset')->name('reset');
	Route::get('/teamdetail/{event_id}/{team_id}', 'Eventcodinator\EventcodinatorController@teamdetail')->name('teamdetail');
	

	Route::prefix('round1')->middleware('auth:eventcodinator')->as('round1.')->group(function() {

		Route::get('/', 'Eventcodinator\Round1Controller@round1')->name('index');
		Route::get('/round1score', 'Eventcodinator\Round1Controller@round1score')->name('round1score');
		Route::get('/addround2', 'Eventcodinator\Round1Controller@addround2')->name('addround2');
		Route::get('/competeforround1', 'Eventcodinator\Round1Controller@competeforround1')->name('competeforround1');
		Route::get('/battle Round 1', 'Eventcodinator\Round1Controller@battle_1')->name('battle_1');
		Route::get('/add in Round 2', 'Eventcodinator\Round1Controller@addinround2')->name('addinround2');
	});

	Route::prefix('round2')->middleware('auth:eventcodinator')->as('round2.')->group(function() {

		Route::get('/', 'Eventcodinator\Round2Controller@round2')->name('index');
		Route::get('/round2score', 'Eventcodinator\Round2Controller@round2score')->name('round2score');
		Route::get('/addround3', 'Eventcodinator\Round2Controller@addround3')->name('addround3');
		Route::get('/battle Round 2', 'Eventcodinator\Round2Controller@battle_2')->name('battle_2');
		Route::get('/add in Round 3', 'Eventcodinator\Round2Controller@addinround3')->name('addinround3');
		Route::get('/choosewinner', 'Eventcodinator\Round2Controller@choosewinner')->name('choosewinner');
		Route::get('/winner', 'Eventcodinator\Round2Controller@winner')->name('winner');
	});

	Route::prefix('round3')->middleware('auth:eventcodinator')->as('round3.')->group(function() {

		Route::get('/', 'Eventcodinator\Round3Controller@round3')->name('index');
		Route::get('/round3score', 'Eventcodinator\Round3Controller@round3score')->name('round3score');
		Route::get('/choosewinner', 'Eventcodinator\Round3Controller@choosewinner')->name('choosewinner');
		Route::get('/battle Round 3', 'Eventcodinator\Round3Controller@battle_3')->name('battle_3');
		Route::get('/winner', 'Eventcodinator\Round3Controller@winner')->name('winner');
	});

	Route::get('/winner', 'Eventcodinator\EventcodinatorController@winner')->name('winner');
	Route::get('/notification', 'Eventcodinator\notificationController@notification')->name('notification');
	Route::get('/notificationforround2', 'Eventcodinator\notificationController@notificationforround2')->name('notificationforround2');
	Route::get('/notificationforround3', 'Eventcodinator\notificationController@notificationforround3')->name('notificationforround3');
	Route::get('/notificationforselectedinround2', 'Eventcodinator\notificationController@notificationforselectedinround2')->name('notificationforselectedinround2');
	Route::get('/notificationforselectedinround3', 'Eventcodinator\notificationController@notificationforselectedinround3')->name('notificationforselectedinround3');

	Route::get('/score', 'Eventcodinator\EventcodinatorController@score')->name('score');
	Route::get('/update/{id}', 'Eventcodinator\EventcodinatorController@update')->name('update');


});

Route::prefix('student')->as('student.')->group(function() {

	Route::get('/login', 'Auth\Student\StudentLoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth\Student\StudentLoginController@login')->name('login.submit');
	Route::get('/', 'Student\StudentController@index')->name('index');
	Route::get('/logout', 'Auth\Student\StudentLoginController@logout')->name('logout');

	Route::get('/register', 'Auth\Student\StudetnRegisterController@create')->name('register');
	Route::post('/register','Auth\Student\StudetnRegisterController@store');

	//password reset router
	Route::post('/password/email', 'Auth\Student\StudentForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('/password/reset', 'Auth\Student\StudentForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('/password/reset', 'Auth\Student\StudentResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\Student\StudentResetPasswordController@showResetForm')->name('password.reset');

	Route::get('/event/{id}', 'Student\StudentController@events')->name('event')->middleware('auth:student');
	Route::get('/colleges', 'Student\StudentController@colleges')->name('college')->middleware('auth:student');
	Route::get('/store', 'Student\PymentController@store')->name('store')->middleware('auth:student');
	Route::get('/registerevent', 'Student\StudentController@registerevent')->name('registerevent');

	Route::get('/team/{id}', 'Student\StudentController@team')->name('team');
	Route::get('/selectteammember/{id}', 'Student\StudentController@selectteammember')->name('selectteammember');
	Route::get('/storemember/{id}', 'Student\StudentController@storemember')->name('storemember');
	Route::get('/destroy/{id}/{event_id}/{enrollment_no}', 'Student\StudentController@destroy')->name('destroy');
	Route::get('/storeforteam', 'Student\PymentController@storeforteam')->name('storeforteam')->middleware('auth:student');
	Route::get('/teamdetail/{id}', 'Student\StudentController@teamdetail')->name('teamdetail')->middleware('auth:student');
	// Route::get('/accept/{event_id}/{team_id}/{enrollment_no}/{leader_enrollment_no}', 'Student\StudentController@accept')->name('accept');
	// Route::get('/score/{event_id}/{team_id}', 'Student\StudentController@score')->name('score');
	Route::get('/score', 'Student\StudentController@score')->name('score');
	Route::get('/edit', 'Student\StudentController@edit')->name('edit');
	Route::put('/update/{id}', 'Student\StudentController@update')->name('update');
	Route::get('/winner', 'Student\StudentController@winner')->name('winner');
	Route::get('/cartificate/{id}', 'Student\StudentController@cartificate')->name('cartificate');

	Route::get('/redirect/{event_id}', 'Student\PymentController@redirect')->name('redirect');
	Route::post('/createRequest', 'Student\PymentController@createRequest')->name('createRequest');

	Route::get('/accept', 'Student\AcceptController@accept')->name('accept');

	Route::get('markAsRead',function(){
		auth()->user()->unreadNotifications->markAsRead();
		return redirect()->back();
	})->name('markAsRead')->middleware('auth:student');
});

// 