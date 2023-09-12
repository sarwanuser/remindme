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

Route::get('/', 'RemindController@index');
Route::get('/create', 'RemindController@create');
Route::post('/store', 'RemindController@store');


Route::get('/text-cron-tab', 'CronTabController@index');
Route::get('/cron-tab', 'CronTabController@create');

Route::get('/check-one-time', 'CheckSchedulerController@checkOneTime');