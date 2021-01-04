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

Auth::routes();

// data routes for ajax
Route::get('/all-users', 'HomeController@allUsers')->name('home.all_users');
Route::get('/user-working-days', 'HomeController@userWorkingDays')->name('home.user_working_days');
Route::get('/schedule-list', 'HomeController@getScheduleList')->name('home.schedule-list');

Route::get('/', 'HomeController@index')->name('home');

Route::put('/create-appointment', 'AppointmentController@create')->name('appointment.create_appointment');