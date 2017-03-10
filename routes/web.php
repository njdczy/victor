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
    return view('home/welcome');
});

Route::post('/vusers', 'VusersController@index')->name('vusers');
Route::get('/calendar', 'CalendarController@index')->name('vusers');
Route::get('/hotel', 'HotelController@index')->name('vusers');
Route::get('/bus', 'BusController@index')->name('vusers');
