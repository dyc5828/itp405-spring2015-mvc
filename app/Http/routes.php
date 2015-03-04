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

// Debug
Event::listen('illuminate.query', function($sql) {
	// echo '<code><pre>'.$sql.'</pre></code>';
});

// Menu Active
HTML::macro('menuActive', function($route) {	
	if( Request::is($route.'/*') || Request::is($route)) {
		$active = 'class="active"';
	}
	else {
		$active = '';
	}
  return $active;
});

// ITP 405 Spring 2015
Route::get('/', 'NavController@index');
Route::get('/home', 'NavController@toIndex');

// A7 - DVD Pages with Eloquent
Route::get('/dvds/create', 'DvdController@create');
Route::post('/dvds', 'DvdController@insert');
Route::get('/dvds/search', 'DvdController@search');
Route::get('/genres/{genre_name}/dvds', 'DvdController@genreDvds');

// A6 - DVD Review Page
Route::get('/dvds/:{id}', 'DvdController@review');
Route::post('/dvds/:{id}', 'DvdController@review');

// A5 - DVD Search Page
Route::get('/dvds/search', 'DvdController@search');
Route::get('/dvds', 'DvdController@results');