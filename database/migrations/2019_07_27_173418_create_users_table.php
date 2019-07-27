<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id')->comment('ID Пользователя');
			$table->string('mob_phone', 60)->comment('Мобильный телефон');
			$table->string('password', 100)->comment('Пароль');
			$table->string('email', 60)->unique('ukEmail')->comment('Email адрес');
			$table->string('full_name', 60)->comment('ФИО');
			$table->string('hobby', 160)->comment('Хобби');
			$table->date('birthday')->comment('День рождения');
			$table->timestamp('registered')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Время регистрации');
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
		Schema::drop('users');
	}

}
