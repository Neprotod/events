<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    protected function get_logs()
    {

    }

    public function index()
    {
        $logs = DB::table('logs as l')
                    ->join("logs_action as la", "la.id","=","l.logs_action_id")
                    ->join("users as u", "u.id","=","l.users_id")->
                    select("l.id", "l.admins_id", "l.users_id", "l.old_value", "l.new_value", "l.timestamp",
                           "u.full_name", "la.action", "la.description"
                    )->orderBy("id","desc")->paginate(10);

        return view("admin/content/home", compact("logs"));
    }
}
