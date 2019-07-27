<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Helpers\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Helpers\Loger;


class CommentsController extends Controller
{
    public function index(){
        $HomeController = new HomeController();
        $comment = $HomeController->sql_message();

        $return = $HomeController->tree($comment["arr"]);
        return view('admin/content/post',["comment" => $return["tree"], 'paginate' => $comment["paginate"]]);
    }
    /**
     * Обновлеяем данные
     */
    public function edit(Request $request)
    {
        // Транзакция для логов
        DB::beginTransaction();

        $old = Message::find($request->id)->toArray();

        $message = Message::find($request->id);

        $admin_id = Auth::guard('admin')->user()->id;

        $message->modify_time = Carbon::now();
        $message->message = $request->input("message");
        $message->save();

        $test["message"] = $request->input("message");

        Loger::add_commit("update_message",array("user"=>$old["user_id"]), $old, $test);

        return redirect()->back()->with('message', 'Пост отредактирован');
    }
    /**
     * удаление
     */
    public function drop($id)
    {
        DB::table('messages')->where('id', '=', $id)->delete();
        return redirect()->back()->with('message', 'Пост удален');
    }
}
