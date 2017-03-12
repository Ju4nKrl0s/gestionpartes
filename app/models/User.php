<?php

//use Illuminate\Auth\UserTrait;
//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableTrait;
//use Illuminate\Auth\Reminders\RemindableInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;
use Cartalyst\Sentry\Groups\GroupInterface;

//class User extends Eloquent implements UserInterface, RemindableInterface {
//class User extends SentryUserModel implements UserInterface, GroupInterface, RemindableInterface {
class User extends SentryUserModel implements GroupInterface/*UserInterface, RemindableInterface*/ {

	//use UserTrait, RemindableTrait;
	/*public $rules = array('first_name' 		=> 	'required',
					'last_name'			=>  'required',
					'email'				=> 	'required|email|unique:users',
					'password'			=>	'min:6',
					'password-repeat'	=>	'same:password'
	);*/

	public static $register_rules = array('first_name' 	=> 	'required',
									'last_name'			=>  'required',
									'email'				=> 	'required|email|unique:users',
									'password'			=>	'required|min:6',
									'password-repeat'	=>	'required|same:password'/*,
									'avatar'			=>	'required|mimes:jpeg,bmp,png',*/
	);

	public static $edit_rules = array('first_name' 	=> 	'required',
									'last_name'			=>  'required',
									'email'				=> 	'required|email|unique:users,email,$id',
									'password'			=>	'min:6',
									'password-repeat'	=>	'same:password'/*,
									'avatar'			=>	'required|mimes:jpeg,bmp,png',*/
	);

	public static $login_rules = array('email' => 'required|email',
										'password' => 'required');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function getRules($id=null) {

		$rules = array('first_name'		=> 	'required',
					'last_name'			=>  'required',
					'email'				=> 	'required|email|unique:users',
					'password'			=>	'min:6',
					'password-repeat'	=>	'same:password'
		);

		if($id == null) {

			$rules['password'] = $rules['password'].'|required';
			$rules['password-repeat'] = $rules['password-repeat'].'|required';
			return $rules;
		} else {
			$rules['email'] = $rules['email'].',email,'.$id;
			return $rules;
		}
		/*$edit_rules = array('first_name' 	=> 	'required',
									'last_name'			=>  'required',
									'email'				=> 	'required|email|unique:users,email,$id',
									'password'			=>	'min:6',
									'password-repeat'	=>	'same:password'
		);*/
	}
// REVISAR
	/*@if($user->inGroup('Admin'))
							<span class="label label-success">{{ 'Admin' }}</span>
						@endif*/



/*
	public function getRememberToken() {
	    return $this->remember_token;
	}

	public function setRememberToken($value) {
	    $this->remember_token = $value;
	}

	public function getRememberTokenName() {
	    return 'remember_token';
	}

	public function getReminderEmail() {
		return 'reminder_email';
	}
*/
	public function getName() {
		return 'name';
	}
/*
	public function getAuthIdentifier() {
		return 'auth_identifier';
	}

	public function getAuthPassword() {
		return 'auth_password';
	}
*/

}
