<?php

namespace App\Helpers;

class Arr
{
    /**
     * Создает 3 массива, для добавления, обновления и удаления.
     *
     * @param старный массив
     * @param новый массив
     */
    public static function insert_update_delete($old, $new)
    {
        $return = array();
        $update = Arr::array_diff_assoc($new, $old);

        $insert = array_diff_key($new, $old);

        $update = Arr::array_diff_assoc($update, $insert);

        $delete = array_diff_key($old, $new);

        $return['insert'] = $insert;
        $return['update'] = $update;
        $return['delete'] = $delete;

        return $return;
    }


    /**
     * Сверяет разницу как  array_diff_assoc только рекурсивно
     *
     *
     *
     * @param  array   Исходный массив
     * @param  array   Массив, с которым идет сравнение
     * @return array
     */
    public static function array_diff_assoc(array $array1, array $array2, $strictly = TRUE)
    {

        $diff = array();

        foreach($array1 AS $key => $value){
            // Если ячейки нет, это уже различие
            if(is_array($array2) AND !array_key_exists($key, $array2)){
                $diff[$key] = $value;
                continue;
            }
            if(is_array($value) AND is_array($array2[$key])){
                // Проверяем на многомерный массив
                if(count($value) == count($value, COUNT_RECURSIVE)){
                    $diff[$key] = array_diff_assoc($value,$array2[$key]);
                    // Если массив пуст, значит все совпадает
                    if(empty($diff[$key])){
                        unset($diff[$key]);
                    }
                }else{
                    // Если массив многомерный, запускаем круг еще раз
                    $diff[$key] = self::array_diff_assoc($value,$array2[$key]);
                    // Если массив пуст, значит все совпадает
                    if(empty($diff[$key])){
                        unset($diff[$key]);
                    }
                }
            }else{
                // Если это не массив, сверяем значения.
                if($strictly){
                    if($value !== $array2[$key]){
                       $diff[$key] =  $value;
                    }
                }else{
                    if($value != $array2[$key]){
                       $diff[$key] =  $value;
                    }
                }
            }
        }

        return $diff;
    }

    /**
     * Превращает объект в массив
     */
    public static function to_array($obj){
        return json_decode(json_encode($obj), true);
    }
}
