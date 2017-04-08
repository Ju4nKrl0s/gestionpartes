<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class AlumnsTableSeeder extends Seeder {

	public function run()
	{
		$alumn = new Alumn;
		$alumn->last_name = 'Cabeza Rojas';
		$alumn->first_name = 'Juan Carlos';
		$alumn->grade_id = 2;
		$alumn->save();

		
	}

}
