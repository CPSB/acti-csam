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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

// Support desk routes 
Route::get('/support/index',     'SupportdeskController@index')->name('support.index');
Route::get('/support/show/{id}', 'SupportdeskController@show')->name('support.show');
Route::get('/support/create',    'SupportDeskController@create')->name('support.create');