<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login', 'HomeController@showLogin');

Route::post('/login', 'HomeController@login');

Route::get('logout', 'HomeController@logout');

/*Route::get('/', function()
{
	return View::make('hello');
});*/

# Admin Routes
Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function() {
//Route::group(array('before' => 'auth|admin'), function() {
	
	//Funciona
	Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@showDashboard']);
	
	Route::get('/users/index', 'UsersController@index');
	Route::get('/users/create', 'UsersController@create');
	Route::post('/users', 'UsersController@store');
	Route::get('/users/{id}/show/', 'UsersController@show');
	Route::get('/users/{id}/edit/', 'UsersController@edit');
	Route::put('/users/{id}', 'UsersController@update');
	Route::delete('/users/{id}', 'UsersController@destroy');

	Route::get('/grades/index', 'GradesController@index');
	Route::get('/grades/create', 'GradesController@create');
	Route::post('/grades', 'GradesController@store');
	Route::get('/grades/{id}/show/', 'GradesController@show');
	Route::get('/grades/{id}/edit/', 'GradesController@edit');
	Route::put('/grades/{id}', 'GradesController@update');
	Route::delete('/grades/{id}', 'GradesController@destroy');

	Route::get('/alumns/index', 'AlumnsController@index');
	Route::get('/alumns/create', 'AlumnsController@create');
	Route::post('/alumns', 'AlumnsController@store');
	Route::get('/alumns/{id}/show/', 'AlumnsController@show');
	Route::get('/alumns/{id}/edit/', 'AlumnsController@edit');
	Route::put('/alumns/{id}', 'AlumnsController@update');
	Route::delete('/alumns/{id}', 'AlumnsController@destroy');
	
	//Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@showDashboard']);
	//Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);
	
	//Route::resource('users', 'UsersController');

	//Route::resource('reports', 'ReportsController');
});
//Route::get('/dashboard', 'HomeController@showDashboard');

//Route::group(array(/*'prefix' => 'admin', */'before' => 'auth|admin'), function() {

	//Route::get('', 'HomeController@showDashboard');
	//Route::get('/frontend', ['as' => 'dashboard', 'uses' => 'HomeController@showDashboard']);
	//Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@showDashboard']);
	
	//Route::get('frontend/dashboard', array('as' => 'dashboard', 'uses' => 'UsersController@index'));
	//Route::resource('users', 'UsersController');
	//Route::resource('admin/reports', 'ReportsController');
//});
/*Route::group(['before' => 'auth|admin'], function() {

	Route::get('/admin', ['as' => 'admin_dashboard', 'uses' => 'AdminController@getHome']);
	Route::resource('admin/profiles', 'AdminUsersController', ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);

});*/

# Standard User Routes
/*Route::group(['before' => 'auth|standardUser'], function() {

	Route::get('userProtected', 'StandardUserController@getUserProtected');
	Route::resource('profiles', 'UsersController', ['only' => ['show', 'edit', 'update']]);
});*/
