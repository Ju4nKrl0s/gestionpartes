<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function() {

	if(!Sentry::check()) {
		return Redirect::guest('login');
		//return Redirect::to('login'); // curso
	}
});

Route::filter('admin', function() {

	$user = Sentry::getUser();
	$admin = Sentry::findGroupByName('Administrador');

	if(!$user->inGroup($admin)) {
		return Redirect::to('login');
	}
});

Route::filter('standardUser', function() {

	$user = Sentry::getUser();
	$users = Sentry::findGroupByName('Usuario');

	if(!$user->inGroup($users)) {
		return Redirect::to('login');
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});*/

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function() {

	if(Sentry::check()) {

		$user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Admin');
		$users = Sentry::findGroupByName('User');

		if($user->inGroup($admin)) {
			
			return Redirect::intended('admin');
		
		} elseif ($user->inGroup($users)) {
			
			return Redirect::intended('/');
		}
	}
});

Route::filter('redirectAdmin', function() {

		if(Sentry::check()) {
			
			$user = Sentry::getUser();
			$admin = Sentry::findGroupByName('Admin');
			
			if($user->inGroup($admin)) {
				
				return Redirect::intended('admin');
			}
		}
});

Route::filter('currentUser', function($route) {

	if(!Sentry::check()) {
		
		return Redirect::home();
	}
	
	if(Sentry::getUser()->id != $route->parameter('profiles')) {
		
		return Redirect::home();
	}
});

/*Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});*/

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
