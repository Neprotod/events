<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsActionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs_action', function(Blueprint $table)
		{
			$table->increments('id')->comment('ID');
			$table->string('action', 30)->unique('ukAction')->comment('Техническое имя');
			$table->string('description', 60)->comment('Описание');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logs_action');
	}

}
