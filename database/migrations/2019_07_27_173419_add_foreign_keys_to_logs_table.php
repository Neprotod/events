<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logs', function(Blueprint $table)
		{
			$table->foreign('logs_action_id', 'fkLogsActionId')->references('id')->on('logs_action')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('admins_id', 'fkLogsAdminId')->references('id')->on('admins')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('users_id', 'fkLogsUsersId')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('logs', function(Blueprint $table)
		{
			$table->dropForeign('fkLogsActionId');
			$table->dropForeign('fkLogsAdminId');
			$table->dropForeign('fkLogsUsersId');
		});
	}

}
