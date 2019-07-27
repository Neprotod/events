<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Helpers\Loger;
class UserController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        $user = User::find($id);

        return view("content/account",compact("user"));
    }

    /**
     * Обновление пользователя и запись в лог
     */
    public function update(Request $request)
    {

        $test = [
            "hobby" => ["required","string","max:60"],
            "email" => ["required",'string', 'email'],
        ];
        if(!empty($request->password)){
            $test['password'] = ['string', 'min:4', 'confirmed'];
        }

        $test = $this->validate($request, $test);

        // Если есть пароль нужно его захешить для сравнения
        if(isset($test['password'])){
            $test['password'] = bcrypt($test['password']);
        }

        $id = Auth::id();

        // Запускаем транзакцию, что бы логи и записи точно добавились вместе.
        DB::beginTransaction();



        // Нам возможно нужен пароль, а модель его скрывает.
        $user = DB::table('users')->where("id","=",$id)->first();

        DB::table('users')
            ->where('id', $id)
            ->update($test);

        Loger::add_commit("update_user",array("user"=>$id),$user, $test);

        return redirect()->back()->with('message', 'Изменения добавлены');
    }
}
