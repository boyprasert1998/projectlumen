<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//$router->get('/profile[/{name}]', function($profileId = null){
//   return 'My profile'. $profileId;
//});

$router->get('/people', 'ProfileController@index');
$router->get('/peoplesearch', 'ProfileController@search');
$router->put('/people', 'ProfileController@store');
$router->put('/peopleupdate/{id}', 'ProfileController@update');
$router->delete('/people/{id}', 'ProfileController@destroy');

$router->group(['prefix' => 'trainee'], function () use ($router) {
    $router->get('/', 'TraineeController@index');
    $router->post('/', 'TraineeController@store');
});

$router->group(['prefix' => 'teacher'], function () use ($router) {
    $router->get('/', 'TeacherController@index');
    $router->post('/', 'TeacherController@store');
    $router->put('/{id}', 'TeacherController@update');
    $router->delete('/{id}', 'TeacherController@destroy');
});
$router->get('/users', 'SocialUserController@index');

$router->get('/feed', 'NewsFeedController@index');
$router->post('/feed', 'NewsFeedController@store');
$router->put('/feed/{id}', 'NewsFeedController@update');
$router->put('/feed/{id}/like', 'NewsFeedController@updateLike');
$router->delete('/feed/{id}', 'NewsFeedController@destroy');

$router->get('/checkIn', 'TimeAttendence@index');
$router->post('/checkIn', 'TimeAttendence@store_in');
$router->put('/checkOut/{id}', 'TimeAttendence@store_out');

//ของบอย
//Leave
$router->get('/leave', 'LeaveController@index');
$router->post('/leave', 'LeaveController@store');
$router->put('/leave/{id}', 'LeaveController@update');

//Deparment
$router->get('/deparment', 'DeparmentController@index');
$router->post('/deparment', 'DeparmentController@store');
$router->get('/deparment/{id}', 'DeparmentController@showUpdate');
$router->put('/deparment/{id}', 'DeparmentController@update');
$router->delete('/deparment/{id}', 'DeparmentController@destroy');

//WorkFormHome
$router->post('/workfromhome', 'WorkFormhomeController@store');
$router->get('/workfromhome', 'WorkFormhomeController@index');
$router->put('/workfromhome/{id}', 'WorkFormhomeController@update');

//Calendar
$router->get('/calendar', 'CalendarController@index');

//Admin
$router->post('/admin', 'AdminController@store');

//User
$router->get('/user', 'UserController@index');
$router->post('/user', 'UserController@store');
$router->put('/user/{id}', 'UserController@update');
$router->get('/user/{id}', 'UserController@showUpdate');
$router->delete('/user/{id}', 'UserController@destroy');

//Time
$router->get('/time', 'TimeController@index');
$router->post('/time', 'TimeController@store');
$router->get('/time/{id}', 'TimeController@showcheckOut');
$router->put('/time/{id}', 'TimeController@update');
$router->delete('/time/{id}', 'TimeController@destroy');

//history
$router->get('/leavehistory', 'LeavehistoryController@index');

//holiday
$router->get('/holiday', 'HolidayController@index');
$router->post('/holiday', 'HolidayController@store');
$router->get('/holiday/{id}', 'HolidayController@showUpdate');
$router->put('/holiday/{id}', 'HolidayController@update');
$router->delete('/holiday/{id}', 'HolidayController@destroy');

//แยกตามพนักงานแต่ละคน
$router->get('/export', 'UsersController@export');
$router->get('/exportcheckin', 'CheckinreportController@export');
$router->get('/exportleave', 'LeavereportController@export');

//รวม
$router->get('/exportleaveall', 'LeaveallreportController@export');
$router->get('/exportcheckinall', 'CheckinallreportController@export');

//Quotaleave
$router->get('/quota', 'QuotaleaveController@index');
$router->post('/quota','QuotaleaveController@store');
$router->post('/quotauser', 'QuotaleaveController@quota');