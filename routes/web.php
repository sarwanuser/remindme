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
Route::get('/edit-{id}', 'RemindController@edit');
Route::post('/update-{id}', 'RemindController@update');
Route::get('/delete-{id}', 'RemindController@delete');

// Run One Time 
Route::get('/run-one-time', 'CheckSchedulerController@runOneTime');

// Run Weekly
Route::get('/run-weekly', 'CheckSchedulerController@runWeekly');