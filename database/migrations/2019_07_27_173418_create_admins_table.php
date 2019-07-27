<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function(Blueprint $table)
		{
			$table->increments('id')->comment('ID Пользователя');
			$table->string('login', 60)->unique('ukLogin')->comment('Мобильный телефон');
			$table->string('email', 60)->unique('ukEmail')->comment('Email адрес');
			$table->string('password', 100)->comment('Пароль');
			$table->string('remember_token', 100)->nullable()->comment('remember_token');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admins');
	}

}
