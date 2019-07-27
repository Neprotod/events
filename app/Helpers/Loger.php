<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Helpers\Arr;
use App\Models\LogsAction;
use PHPUnit\Runner\Exception;
/**
 * Этот хелпер отвечает за добавление запесей в таблицу logs.
 */
class Loger
{
    /**
     * single tone
     */
    private static $init = '';

    /**
     * @var все action таблицы
     */
    public $type = array();

    /**
     * Делаем singleton только с одной целью, что бы не нагружать базу и брать action из свойства
     */
    protected function __construct(){
        $this->type = DB::table('logs_action')->orderBy("action")->get();
        $arr = array();
        foreach($this->type as $key => $value){
            $arr[$value->action] = $value;
        }
        $this->type = $arr;
    }

    public static function i()
    {
        if ( ! isset( self::$init ) ) {
            self::$init = new self();
        }
        return self::$init;
    }

    /**
     * Псевдоним add только с commit транзакции.
     */
    public static function add_commit($type, $ids = null, $old_value = null, $new_value = null)
    {
        try{
            $result = self::add($type, $ids, $old_value, $new_value);
            DB::commit();
            return  $result;
        }catch(Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
    /**
     * Записывает в лог события двух типов, добавление или обновление
     *
     * @param тип события
     * @param должен быть массив user->id,admin->id
     * @param старый массив
     * @param новый массив
     */
    public static function add($type, $ids = null, $old_value = null, $new_value = null)
    {
        // Парсим в массивы
        $old_value = Arr::to_array($old_value);
        $new_value = Arr::to_array($new_value);

        $user_id = (isset($ids["user"]))?$ids["user"]:NULL;
        $admin_id = (isset($ids["admin"]))?$ids["admin"]:NULL;

        $allType = (new Self())->type;

        if(!isset($allType[$type])){
            throw new Exception("Нет такого типа $type");
        }
        if(empty($user_id) and empty($admin_id)){
            throw new Exception("Нет не одного ID пользователей");
        }



        $test = Arr::insert_update_delete($old_value,$new_value);

        $update = $test["update"];

        if(empty($update)){
            return false;
        }

        $id = $allType[$type]->id;
        $compil = Self::compil($update, $old_value);

        DB::table('logs')->insert([
            'logs_action_id' => $id,
            'admins_id' => $admin_id,
            'users_id' => $user_id,
            'old_value' => $compil["old"],
            'new_value' => $compil["new"],

            ]);

        return true;
    }

    /**
     * Просто собирает строку до и после и возвращает ее для вставки в таблицу logs.
     */
    protected static function compil($update, $old_value){
        $tmp = array(
            "new" => '',
            "old" => ''
        );
        //dd($update);

        foreach($update as $key => $value){
            if(isset($old_value[$key])){
                $tmp["old"] = $key . " = " . $old_value[$key] ."; ";
            }
            $tmp["new"] = $key . " = " . $value ."; ";
        }
        // очищаем лишнее
        $tmp["new"] = trim($tmp["new"]);
        $tmp["old"] = trim($tmp["old"]);

        return $tmp;
    }
}
