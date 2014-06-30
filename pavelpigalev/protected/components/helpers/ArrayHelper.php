<?php

/**
 * Класс-помощник, призванный производить нетривиальные манипуляции с массивами
 */
class ArrayHelper
{

    /**
     * Преобразовывает массив в строку
     *
     * @param array $array - входной массив
     * @param string $delimiter - чем разделять элементы массива в выходной строке
     * @param string $default - что возвращать, если массив пустой
     * @param bool $assoc - использовать ключи массива при фомировании выходной строки
     * @param string $assocDelimiter - разделитель между ключем и значением, если $assoc = true
     * @return string - итоговая строка
     * */
    public static function arrayToString($array, $delimiter = ',', $default = '0', $assoc = false, $assocDelimiter = '=')
    {
        if (empty($array) || !is_array($array)) {
            return $default;
        }
        if ($assoc) {
            $return = '';
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    $v = '[' . self::arrayToString($v, $delimiter, $default, true) . ']';
                }
                $return .= (empty($return) ? "" : $delimiter) . (!is_int($k) ? $k . $assocDelimiter : '') . $v;
            }
        } else {
            $return = implode($delimiter, $array);
        }
        return empty($return) ? $default : $return;
    }

    /**
     * explode с несколькими делиметрами
     * @param array|string $delimiters
     * @param string $string
     * @param bool $explain
     * @return array
     * */
    public static function explodeX($delimiters, $string, $explain = false)
    {
        $string = str_replace($delimiters, ' ', $string);
        if ($explain) {
            $explode = explode(' ', $string);
            $result  = array();
            foreach ($explode as $item) {
                if (empty($result)) {
                    $result[0] = $item;
                } else {
                    end($result);
                    $result[key($result) + 1 + mb_strlen($result[key($result)])] = $item;
                }
            }
            foreach ($result as $k => $v) {
                if ($v === '') {
                    unset($result[$k]);
                }
            }
        } else {
            $string = preg_replace('/\s+/', ' ', $string);
            $result = explode(' ', $string);
        }
        return $result;
    }

    /**
     * Преобразовывает значения массива по ключам другого массива
     *
     * @param array $arrayKeys - входной массив
     * @param array $arrayValues - массив (ключ -> значение), где ключ - одно из возможных значений $arrayKeys
     * @param array $defaultKey - использовать этот массив, если входной пустой
     * @return array - итоговый массив
     * */
    public static function arrayByAnother($arrayKeys, $arrayValues, $defaultKey = array())
    {
        $array = array();
        if (empty($arrayKeys)) {
            $arrayKeys = $defaultKey;
        }
        foreach ($arrayKeys as $value) {
            if (isset($arrayValues[$value])) {
                $array[] = $arrayValues[$value];
            }
        }
        return $array;
    }

    /**
     * Сортировка массива по другому массиву
     * @param array $array - входной массив (id => массив)
     * @param array $relation - массив сортировки (id => значение для сортировки[timestamp или int или еще что-то])
     * @param bool $desc
     * @return array
     * */
    public static function sortByRelation($array, $relation, $desc = true)
    {
        $desc ? arsort($relation) : asort($relation);
        foreach ($relation as $k => $v) {
            if (isset($array[$k])) {
                $relation[$k] = $array[$k];
            } else {
                unset($relation[$k]);
            }
        }
        return $relation;
    }

    /**
     * Удаляет Closure Object из массива.
     *
     * @param array $array
     * @return array
     */
    public static function removeClosures($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::removeClosures($value);
            } else {
                if (is_object($value) && ($value instanceof Closure)) {
                    unset($array[$key]);
                }
            }
        }

        return $array;
    }

    public static function checkEmptiness($array)
    {
        if (!is_array($array)) {
            return empty($array);
        } else {
            if (!empty($array)) {
                foreach ($array as $inner) {
                    if(!self::checkEmptiness($inner)) {
                        return false;
                    }
                }
                return true;
            } else {
                return empty($array);
            }
        }
    }
}