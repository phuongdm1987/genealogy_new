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
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/verify-email/{confirmation_code}', 'Auth\RegisterController@verify')->name('verify');

Route::resource('parents', 'ParentController');
Route::resource('siblings', 'SiblingController');
Route::resource('marriages', 'MarriageController');
Route::resource('children', 'ChildController');
Route::resource('users', 'UserController');

Route::get('account', 'AccountController@index')->name('profile.index');
Route::post('account', 'AccountController@update')->name('profile.update');
Route::post('account/change-password', 'AccountController@changePassword')->name('profile.change.password');

Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
