<?php

class App
{
    /**
     * @param mixed $arr
     * @param bool $vd - использовать var_dump вместо print_r
     * */
    public static function pr($arr, $vd = false)
    {
        echo "<pre>";
        $vd ? var_dump($arr) : print_r($arr);
        echo "</pre>";
    }

    /**
     * Показ только нужных значений
     * @param object|array $o - объект или массив объектов или массив массивов
     * @param string|array $v - значение или массив значений, которые вывести
     * @param bool $vd - использовать var_dump вместо print_r
     * */
    public static function showValues($o, $v, $vd = false) {
        if(!is_array($o)) {
            $o = array($o);
        }
        if(!is_array($v)) {
            $v = array($v);
        }
        $return = array();
        foreach($o as $ok => $ov) {
            foreach($v as $vv) {
                if(is_array($ov) && isset($ov[$vv])) {
                    $return[$ok][$vv] = $ov[$vv];
                } elseif(is_object($ov) && isset($ov->{$vv})) {
                    $return[$ok][$vv] = $ov->{$vv};
                }
            }
        }
        self::pr($return, $vd);
    }
}