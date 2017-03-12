<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlumnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alumns', function(Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('first_name');
			$table->string('last_name');
			$table->integer('grade_id')->unsigned();
			$table->foreign('grade_id')->references('id')->on('grades');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alumns');
	}

}
