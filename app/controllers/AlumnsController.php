<?php

class AlumnsController extends \BaseController {

	/**
	 * Display a listing of alumns
	 *
	 * @return Response
	 */
	public function index()
	{
		$alumns = Alumn::all();

		return View::make('alumns.index', compact('alumns'));
	}

	/**
	 * Show the form for creating a new alumn
	 *
	 * @return Response
	 */
	public function create()
	{
		$grades = Grade::all();
		$array_grades = [];
		foreach ($grades as $grade) {
			$array_grades = array_add($array_grades, $grade->id, $grade->name);
		}

		return View::make('alumns.create', compact('array_grades'));
	}

	/**
	 * Store a newly created alumn in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Alumn::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator,'createuser')->withInput();
		}

		//Alumn::create($data);
		$alumn = new Alumn;
		$alumn->first_name = Input::get('first_name');
		$alumn->last_name = Input::get('last_name');
		$alumn->grade_id = Input::get('grade');

		if($alumn->save()) {

			return Redirect::to('admin/alumns/index')->with('message','Alumno '.$alumn->first_name.' '.$alumn->last_name.' creado.');
		} else {

			return Redirect::to('admin/alumns/create')->withInput()->with('message','Se ha producido un error al crear el curso. Vuelva a intentarlo.');
		}

		//return Redirect::route('alumns.index');
	}

	/**
	 * Display the specified alumn.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$alumn = Alumn::findOrFail($id);

		return View::make('alumns.show', compact('alumn'));
	}

	/**
	 * Show the form for editing the specified alumn.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$alumn = Alumn::find($id);
		$grades = Grade::all();
		$alumn_grade = $alumn->grade_id;
		$array_grades = [];

		foreach ($grades as $grade) {
			$array_grades = array_add($array_grades, $grade->id, $grade->name);
		}

		return View::make('alumns.edit', compact('alumn', 'alumn_grade', 'array_grades'));
	}

	/**
	 * Update the specified alumn in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//$alumn = Alumn::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Alumn::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$alumn = Alumn::findOrFail($id);
		
		//$alumn->update(Input::all());
		$alumn->first_name = Input::get('first_name');
		$alumn->last_name = Input::get('last_name');
		$alumn->grade_id = Input::get('grade');
		$alumn->save();

		return Redirect::to('admin/alumns/index')->with('message','Alumno '.$alumn->id.' actualizado.');
		//return Redirect::route('alumns.index');
	}
	/*public function update($id)
	{
		$validator = Validator::make($data = Input::all(), Alumn::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$alumn = Alumn::findOrFail($id);
		$alumn->first_name = Input::get('first_name');
		$alumn->last_name = Input::all('last_name');
		$alumn->save();
		return Redirect::to('admin/alumns/index')->with('message','Alumno '.$alumn->id.' editado.');		
	}*/

	/**
	 * Remove the specified alumn from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Alumn::destroy($id);
		//return Redirect::route('users.index');
		return Redirect::to('admin/alumns/index')->with('message','Alumno '.$id.' eliminado.');
	}

}
