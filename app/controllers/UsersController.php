<?php

//use Cartalyst\Sentry\Groups\GroupInterface;

class UsersController extends \BaseController/* implements GroupInterface*/{

	/*public function __construct() {
		
		$this->beforeFilter('auth');
		
	}*/

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index() {

		$users = User::all();
		$current_user = Sentry::getUser();
		$admin = Sentry::findGroupByName('Administrador');// para etiqueta admin en listado de usuarios
		/*echo '<pre>';
		print_r($users->toArray());
		die();*/

		//return View::make('admins.index', compact('users'));
		//return View::make('frontend.dashboard', compact('users'));
		//return View::make('users.index', compact('users'));
		return View::make('users.index', compact('users', 'current_user', 'admin'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create() {

		$groups = Sentry::findAllGroups();
		$array_groups = [];
		foreach ($groups as $group) {
			$array_groups = array_add($array_groups, $group->id, $group->name);
		}

		return View::make('users.create', compact('array_groups'));
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store() {

		//$validator = Validator::make($data = Input::all(), User::$register_rules);
		$validator = Validator::make($data = Input::all(), User::getRules(null));

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator,'createuser')->withInput(); // añadido createuser
		}

		/*$user = Sentry::register(array(
			'email'			=> Input::get('email'),
			'password'		=> Input::get('password'),
			'first_name'	=> Input::get('first_name'),
			'last_name'		=> Input::get('last_name')
		));*/
		//$group = Input::get('account_type'); // toma el id del grupo del value seleccionado
		$user = Sentry::createUser(array(
			'email'			=> Input::get('email'),
			'password'		=> Input::get('password'),
			'first_name'	=> Input::get('first_name'),
			'last_name'		=> Input::get('last_name'),
			'activated'		=> true/*,
			'permissions'	=> array('id' => Input::get('account_type'))*/
		));
		$user_group = Sentry::findGroupById(Input::get('account_type'));
		$user->addGroup($user_group); // agrega el grupo al usuario creado
		//$user->addGroup('Administrador');

		return Redirect::to('admin/users/index')->with('message','Usuario '.$user->email.' creado.');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		
		$user = User::findOrFail($id);
		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {

		$user = User::find($id);
		$groups = Sentry::findAllGroups();
		$user_group = $user->getGroups()->first()->id;
		$array_groups = [];

		foreach ($groups as $group) {
			$array_groups = array_add($array_groups, $group->id, $group->name);
		}

		return View::make('users.edit', compact('user', 'user_group', 'array_groups'));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

		$validator = Validator::make($data = Input::all(), User::getRules($id));

		if($validator->fails()) {

			return Redirect::back()->withErrors($validator)->withInput();
		}

		// Find the user using the user id
	    $user = Sentry::findUserById($id);
	    //$user->update(Input::all());
	    
	    $user->update(Input::except('account_type')); // actualiza tabla users

	    $user_group = Sentry::findGroupById(Input::get('account_type'));
		//$user->addGroup($user_group); // agrega el grupo al usuario creado
		DB::table('users_groups')
            ->where('user_id', $id)
            ->update(array('group_id' => Input::get('account_type')));

	    return Redirect::to('admin/users/index')->with('message','Usuario '.$user->id.' actualizado.');


		/*$user = User::findOrFail($id);

		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		return Redirect::route('users.index');*/
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

		User::destroy($id);
		//return Redirect::route('users.index');
		return Redirect::to('admin/users/index')->with('message','Usuario '.$id.' eliminado.');
		// solo funciona si pongo index en la ruta
	}
}
