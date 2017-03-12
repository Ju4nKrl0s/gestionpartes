<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showLogin() {

		return View::make('frontend.login');
	}

	public function login() {
		
		try {
		    //TO-DO: Validar las credenciales primero 
		    
		    $credentials = array(
		        'email'    => Input::get('email'),
		        'password' => Input::get('password'),
		    );
		
		    // Authenticate the user
		    $user = Sentry::authenticate($credentials, false);
		    
		    if(!empty($user)) {
			   
			   $group = Sentry::findGroupByName('Administrador');

			   if($user->inGroup($group)) {
			   		return Redirect::route('dashboard'); // dirige a dashboard administradores
			   		//return Redirect::route('admin.users.index'); // dirige a dashboard administradores
			   } else {

			   		return Redirect::route('users.index'); // dirige a dashboard usuarios
			   }
			   

			}
		    
		    return Redirect::to('login')->withInput()->with('message',$message);
		
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
		    $message =  'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
		    $message =  'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
		    $message =  'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
		    $message =  'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
		    $message =  'User is not activated.';
		}
		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
		    $message =  'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
		    $message = 'User is banned.';
		}
		
		return Redirect::to('login')->withInput()->with('message',$message);
		
	}

	public function showDashboard() {

		return View::make('frontend.dashboard');
		
		//$users = User::all();
		//return View::make('users.index', compact('users'));
	}

	public function logout() {

		Sentry::logout();
		return Redirect::to('login')->with('message','Logout correcto');
	}
	/*public function loginUser(){
		
		
		$rules = array( 'email'		=> 	'required|email',
						'password'	=>	'required|min:6');
									
		$validator = Validator::make(Input::all(), User::$loginRules);	
		
		if($validator->passes()){
			
			if(Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){
				
				if(Auth::check())
					return Redirect::to('dashboard')->with('message','Usuario logeado');
				else
					return Redirect::to('login')->with('message', 'Usuario / Password no validos');
								
			} else {
			
				return Redirect::to('login')->with('message', 'Usuario / Password no validos');
			
			}
		
		} else {
			
			return Redirect::to('login')->withErrors($validator,'login');
		}
		
	}*/

	/*public function showWelcome()
	{
		return View::make('hello');
	}*/

}
