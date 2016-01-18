<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DonorsController@create');
Route::get('home', 'DonorsController@index');
Route::resource('/donors', 'DonorsController');
Route::post('/donors', 'DonorsController@sendMail');
Route::get('/donor/confirm', 'EmailConfirmationController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Route::get('/filter', 'DonorsController@index');
Route::post('/filter', 'DonorsController@filterDonors');
