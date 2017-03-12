<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class GradeTableSeeder extends Seeder {

	public function run()
	{
		$grade = new Grade;
		$grade->name = '1DAW';
		$grade->save();

		$grade = new Grade;
		$grade->name = '2DAW';
		$grade->save();

		$grade = new Grade;
		$grade->name = '1ASIR';
		$grade->save();

		$grade = new Grade;
		$grade->name = '2ASIR';
		$grade->save();
	}

}