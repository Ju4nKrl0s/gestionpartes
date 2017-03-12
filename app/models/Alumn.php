<?php

class Alumn extends \Eloquent {

	/*// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];*/

	public static $rules = array('first_name'	=> 	'required',
					'last_name'	=>  'required',
					'grade'		=> 	'required'
	);

}