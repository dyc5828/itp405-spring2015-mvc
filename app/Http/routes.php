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

// Route::get('/', 'WelcomeController@index');

// Route::get('home', 'HomeController@index');

// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);

// ITP 405 Spring 2015
Route::get('/', 'NavController@index');
Route::get('/home', 'NavController@toIndex');

// A6 - DVD Review Page
Route::get('/dvds/:{id}', 'DvdController@review');
Route::post('/dvds/:{id}', 'DvdController@review');

// A5 - DVD Search Page
Route::get('/dvds/search', 'DvdController@search');
Route::get('/dvds', 'DvdController@results');