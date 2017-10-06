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

// Notifications routes
Route::get('/notifications',            'NotificationsController@index')->name('notifications.index');
Route::get('/notification/read/all',    'NotificationsController@markAllAsRead')->name('notifications.read.all');
Route::get('/notifications/read/{id}', 'NotificationsController@markAsRead')->name('notifications.read');

// Account settings controller.
Route::get('/account/settings',             'AccountSettingsController@index')->name('account.settings');
Route::post('/account/settings/security',   'AccountSettingsController@updateSecurity')->name('account.settings.security');
Route::post('/account/settings/info',       'AccountSettingsController@updateInfo')->name('account.settings.info');

// Priority routes
Route::get('priority/create',       'PriorityController@create')->name('priority.create');
Route::get('priority/edit/{id}',    'PriorityController@edit')->name('priority.edit');
Route::get('priority/delete/{id}',  'PriorityController@delete')->name('priority.delete');
Route::post('priority/update/{id}', 'PriorityController@update')->name('priority.update');
Route::post('priority/store',       'PriorityController@store')->name('priority.store');

// Support desk routes
Route::get('/support/index',     'SupportdeskController@index')->name('support.index');
Route::get('/support/show/{id}', 'SupportdeskController@show')->name('support.show');
Route::get('/support/create',    'SupportDeskController@create')->name('support.create');
Route::post('/support/store',    'Supportdeskcontroller@store')->name('support.store');

// Category routes
Route::get('/categories/create',     'CategoryController@create')->name('category.create');
Route::get('/categories/edit/{id}',  'CategoryController@edit')->name('category.edit');
Route::get('/category/delete/{id}',  'CategoryController@delete')->name('category.delete');
Route::post('/categories/edit/{id}', 'CategoryController@update')->name('category.update');
Route::post('/categories/store',     'CategoryController@store')->name('category.store');

// Comment routes.
Route::post('/comments/store/{id}', 'CommentsController@store')->name('comments.store');
Route::get('/comments/delete/{id}', 'CommentsController@destroy')->name('comments.delete');
