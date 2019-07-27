<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'mob_phone' => '+380662225544',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user'),
            'full_name' => "Сумкин Федор Владимерович",
            'hobby' => "Приключения",
            'birthday' => "1990-11-02",
        ]);

        DB::table('admins')->insert([
            'login' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        // Добавляем события
        DB::table('logs_action')->insert([
            'action' => 'update_user',
            'description' => 'Обновление пользователя',
        ]);

        DB::table('logs_action')->insert([
            'action' => 'update_message',
            'description' => 'Обновление записей',
        ]);

        DB::table('logs_action')->insert([
            'action' => 'regist',
            'description' => 'Пользователь зарегистрировался',
        ]);

        DB::table('logs_action')->insert([
            'action' => 'drop_user',
            'description' => 'Пользователь удален',
        ]);
    }
}
