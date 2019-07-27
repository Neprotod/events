<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\Loger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Вывод всех пользователей
     */
    public function index()
    {
        $users = User::paginate(20);
        return view("admin/content/users", compact('users'));
    }
    /**
     * Вывод одного пользователя
     */
    public function user($id){
        $user = User::find($id);
        return view("admin/content/user", compact("user"));
    }
    /**
     * Удаление пользователя
     */
    public function drop($id){
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect()->back()->with('message', 'Пользователь удален');
    }

    /**
     * Добавляем пользователя
     */
    public function update($id, Request $request)
    {


        $test = $this->validate($request, [
            'full_name' => ['required', 'string'],
            'mob_phone' => ['required', 'string', 'max:20'],
            'hobby' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        // Если есть пароль нужно его захешить для сравнения
        if(isset($test['password'])){
            $test['password'] = bcrypt($test['password']);
        }

        $admin_id = Auth::guard('admin')->user()->id;
         // Запускаем транзакцию, что бы логи и записи точно добавились вместе.
         DB::beginTransaction();

         // Нам возможно нужен пароль, а модель его скрывает.
         $user = DB::table('users')->where("id","=",$id)->first();

         DB::table('users')
             ->where('id', $id)
             ->update($test);

        Loger::add_commit("update_user",array("user"=>$id,"admin" => $admin_id),$user, $test);

        return redirect()->back()->with('message', 'Изменения добавлены');
        //$user = User::find($id);
        //return view("admin/content/user", compact("user"));
    }
}
