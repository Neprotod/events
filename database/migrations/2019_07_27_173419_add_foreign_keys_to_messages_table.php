<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('messages', function(Blueprint $table)
		{
			$table->foreign('parent_id', 'fkMessagesParentId')->references('id')->on('messages')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id', 'fkMessagesUsersId')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('messages', function(Blueprint $table)
		{
			$table->dropForeign('fkMessagesParentId');
			$table->dropForeign('fkMessagesUsersId');
		});
	}

}
