<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function(Blueprint $table)
		{
			$table->increments('id')->comment('ID');
			$table->integer('logs_action_id')->unsigned()->index('ixLogsActionId')->comment('ID события');
			$table->integer('admins_id')->unsigned()->nullable()->index('ixAdminsId')->comment('id администратора, если поле пустое, значит событие делал пользователь.');
			$table->integer('users_id')->unsigned()->index('ixUsersId')->comment('id пользователя, который или над которым происходит изменение.');
			$table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Время создания');
			$table->text('old_value', 65535)->nullable()->comment('Старые значения');
			$table->text('new_value', 65535)->nullable()->comment('Новые значения');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logs');
	}

}
