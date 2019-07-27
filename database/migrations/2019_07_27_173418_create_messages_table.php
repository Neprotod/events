<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id')->comment('ID сообщения');
			$table->integer('parent_id')->unsigned()->nullable()->index('ixParentId')->comment('ID родителя');
			$table->integer('user_id')->unsigned()->nullable()->index('ixUserId')->comment('ID пользователя');
			$table->timestamp('create_time')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Время создания');
			$table->dateTime('modify_time')->nullable()->comment('Время изменения');
			$table->text('message', 65535)->comment('Сообщение');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}
