<?php

class GradesController extends \BaseController {

	/**
	 * Display a listing of grades
	 *
	 * @return Response
	 */
	public function index()
	{
		$grades = Grade::all();

		return View::make('grades.index', compact('grades'));
	}

	/**
	 * Show the form for creating a new grade
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('grades.create');
	}

	/**
	 * Store a newly created grade in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Grade::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator,'creategrade')->withInput(); // añadido creategrade
		}

		//Grade::create($data);
		$grade = new Grade;
		$grade->name = Input::get('name');

		if($grade->save()) {

			return Redirect::to('admin/grades/index')->with('message','Curso '.$grade->name.' creado.');
		} else {

			return Redirect::to('admin/grades/create')->withInput()->with('message','Se ha producido un error al crear el curso. Vuelva a intentarlo.');
		}

		//return Redirect::to('admin/grades/index')->with('message','Curso creado.');
		//return Redirect::route('grades.index');
	}

	/**
	 * Display the specified grade.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$grade = Grade::findOrFail($id);

		return View::make('grades.show', compact('grade'));
	}

	/**
	 * Show the form for editing the specified grade.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$grade = Grade::find($id);

		return View::make('grades.edit', compact('grade'));
	}

	/**
	 * Update the specified grade in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//$grade = Grade::findOrFail($id);
		//$grade = Grade::find($id);

		//$validator = Validator::make($data = Input::all(), Grade::$rules);
		$validator = Validator::make($data = Input::all(), Grade::getRules($id));

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		//$grade->update(Input::get('name')); // PETA

		$grade = Grade::findOrFail($id);
		$grade->name = Input::get('name');
		$grade->save();
		return Redirect::to('admin/grades/index')->with('message','Curso '.$grade->name.' editado.');		
		/*$grade = new Grade;
		$grade->name = Input::get('name');

		if($grade->save()) {

			return Redirect::to('admin/grades/index')->with('message','Curso '.$grade->name.' editado.');
		} else {

			return Redirect::to('admin/grades/create')->withInput()->with('message','Se ha producido un error al editar el curso. Vuelva a intentarlo.');
		}*/

		//return Redirect::route('grades.index');
	}

	/**
	 * Remove the specified grade from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Grade::destroy($id);
		return Redirect::to('admin/grades/index')->with('message','Curso '.$id.' eliminado.');
		//return Redirect::route('grades.index');
	}

}
