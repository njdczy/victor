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

Route::get('/u', 'IndexController@conference');
Route::get('/', 'IndexController@conference');

Route::get('/u/{id}', 'IndexController@welcome')->name('invite');


Route::get('/intro', 'IndexController@intro')->name('intro');
Route::get('/conference', 'IndexController@conference')->name('conference');
Route::get('/bus', 'IndexController@bus')->name('bus');
Route::get('/seat', 'IndexController@seat')->name('seat');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/hotel', 'VusersController@hotel')->name('hotel');
Route::get('/home', 'VusersController@index')->name('home');

