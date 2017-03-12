<?php

class Grade extends \Eloquent {

	// Add your validation rules here
	/*public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];*/
	public static $rules = array('name'	=> 'required|unique:grades');

	public static function getRules($id=null) {

		$rules = array('name' => 'required|unique:grades');
		if($id == null) {

			return $rules;
		} else {

			$rules['name'] = $rules['name'].',name,'.$id;
			return $rules;
		}
			
	}

}