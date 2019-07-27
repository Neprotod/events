<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\Loger;

class CommentsController extends Controller
{
    /**
     * Добавление нового сообщения
     */
    protected function add($request, $id_user, $parent_id){
        // Просто добавляем запись если она не пустая.
        $message = new Message();

        $message->user_id = $id_user;
        $message->parent_id = $parent_id;
        //$message->modify_time = Carbon::now();
        $message->message = $request->input("message");

        $message->save();

        return redirect()->back()->with('message', 'Пост добавлен');
    }
    /**
     * Редактирует сообщение
     */
    protected function edit($request, $id_user, $parent_id){

        // Транзакция для логов
        DB::beginTransaction();

        $old = Message::find($request->id)->toArray();

        $message = Message::find($request->id);

        $message->modify_time = Carbon::now();
        $message->message = $request->input("message");
        $message->save();

        $test["message"] = $request->input("message");

        Loger::add_commit("update_message",array("user"=>$id_user), $old, $test);

        return redirect()->back()->with('message', 'Пост отредактирован');
    }
    /**
     * Распределяем запросы между другими методами
     */
    public function comment(Request $request){
        $id_user = Auth::id();
        $parent_id = null;
        $modify_time = NULL;
        if(isset($request->add)){
            return $this->add($request, $id_user, $parent_id);
        }else if(isset($request->edit)){
            return $this->edit($request, $id_user, $parent_id);
        }else if(isset($request->answer)){
            return $this->add($request, $id_user, $request->id);
        }
    }
}
