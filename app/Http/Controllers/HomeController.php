<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use App\Helpers\Arr;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function tree($categories)
    {


        $tree = array();
		$tree['subcategory'] = array();

		//Массив для сохранения категорий
		$pointer = array();
		$pointer[0] = &$tree;
        $pointer[0]['level'] = 0;

        $tmp = array();
        foreach($categories as $key => $value){
            if($value['parent_id'] === null){
                $value['parent_id'] = 0;
            }
            $tmp[$value["id"]] = $value;
        }
        $categories = $tmp;

        //Создаем древо категорий если они есть
		foreach($categories AS $k=>$category){
			if(isset($category['parent_id'])){
				//Ссылка что бы была подвложенность
				$pointer[$category['parent_id']]['subcategory'][] =& $pointer[$category['id']];
                $pointer[$category['id']] = $category;

                if(!isset($pointer[$category['id']]['level'])){
                    $pointer[$category['id']]['level'] = 0;
                }

                if(!isset($pointer[$category['parent_id']]['level'])){
                    $pointer[$category['parent_id']]['level'] = 0;
                }

				$pointer[$category['id']]['level'] = 1+$pointer[$category['parent_id']]['level'];
			}
		}
		unset($categories);

		//Берем все ключи категорий
		$ids = array_keys($pointer);

		$parent_child = array('parent','children');

		//Отберем детей начиная с родителей
		foreach($parent_child AS $key =>$relative){
			//Переворачиваем массив
			if($key > 0)
				$ids = array_reverse($ids);
			//Отберем детей и родителей
			foreach($ids as $id){
				if($id>0){
					if($pointer[$id]['parent_id'] > 0 OR $relative == 'children')
						$pointer[$id][$relative][] = ($relative != 'children')? $pointer[$id]['parent_id'] : $id;

					//Создаем массив родителей
					if(isset($pointer[$pointer[$id]['parent_id']][$relative])){
							$pointer[$id][$relative] = array_merge($pointer[$id][$relative],$pointer[$pointer[$id]['parent_id']][$relative]);
					}else{
						if($relative == 'children')
							$pointer[$pointer[$id]['parent_id']][$relative] = $pointer[$id][$relative];
					}
				}
			}

		}

		unset($pointer[0],$ids);

        $tmp = array();

		//Заполняем переменные
		$tmp["tree"] = $tree['subcategory'];
        $tmp["all"] = $pointer;

        return $tmp;
    }
    /**
     * Sql запрос для админки и пользователей
     */
    public function sql_message(){
        // Так как сами ответы являются недимыми я буду делать пагинацию по верхнему уровнею уровню
        // Что бы исключить срезу, буду делать в два запроса.
        $paginator = DB::table('messages as m')
                ->join('users as u', 'u.id', '=', 'm.user_id')
                ->select('m.id', 'm.parent_id', 'm.user_id', 'm.create_time', 'm.modify_time', 'm.message',
                        'u.full_name')
                ->whereNull("parent_id")->orderBy("id","desc")->paginate(10);

        $array = Arr::to_array($paginator->items());

        $ids = array();

        foreach($array as $key => $value){
            $ids[] = $value['id'];
        }

        // Второй запрос, достаем детей
        $child = DB::table('messages as m')
                ->join('users as u', 'u.id', '=', 'm.user_id')
                ->select('m.id', 'm.parent_id', 'm.user_id', 'm.create_time', 'm.modify_time', 'm.message',
                        'u.full_name')
                ->whereIn("parent_id", $ids)->orderBy("id","desc")->get();

        $child = Arr::to_array($child);

        $return = array("arr" => array(), 'paginate' => $paginator);

        $return["arr"] = array_merge($array,$child);

        return $return;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Берем записи
        $comment = $this->sql_message();
        $return = $this->tree($comment["arr"]);
        //dd($return["tree"]);
        return view('content/home',["comment" => $return["tree"], "user_id" => Auth::id(), 'paginate' => $comment["paginate"]]);
    }

}
