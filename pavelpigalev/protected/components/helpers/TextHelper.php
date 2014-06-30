<?php

/**
 * Класс-помощник, призванные производить нетривиальные манипуляции с текстом
 */
class TextHelper
{
    /**
     * Преобразует строку к URL-виду. Фактически производит транслитерацию и заменяет пробелы и некоторые другие
     * символы в знаки подчёркивания
     *
     * @param $string
     * @return string
     */
    public static function urlFormat($string)
    {
        $string = mb_strtolower(trim($string));

        $replacement = array(
            'а'  => 'a',
            'б'  => 'b',
            'в'  => 'v',
            'г'  => 'g',
            'д'  => 'd',
            'е'  => 'e',
            'ё'  => 'yo',
            'ж'  => 'zh',
            'з'  => 'z',
            'и'  => 'i',
            'й'  => 'y',
            'к'  => 'k',
            'л'  => 'l',
            'м'  => 'm',
            'н'  => 'n',
            'о'  => 'o',
            'п'  => 'p',
            'р'  => 'r',
            'с'  => 's',
            'т'  => 't',
            'у'  => 'u',
            'ф'  => 'f',
            'х'  => 'h',
            'ц'  => 'c',
            'ч'  => 'ch',
            'ш'  => 'sh',
            'щ'  => 'shch',
            'ъ'  => '',
            'ы'  => 'y',
            'ь'  => '',
            'э'  => 'e',
            'ю'  => 'yu',
            'я'  => 'ya',
            ' '  => '-',
            '&'  => 'and',
            '/'  => '-',
            '\\' => '-',
        );

        $string = strtr($string, $replacement);

        $string = preg_replace('/[^0-9a-z-]+/i', '', $string);
        $string = preg_replace('/-{2,}/', '-', $string);

        return $string;
    }

    /**
     * Сформировать рандомную строку
     *
     * @param int $length - длина строки
     * @param mixed $type - только числа ('num'), только буквы ('alpha') или любые символы (null)
     * @return string
     * */
    public static function randomString($length = 8, $type = null)
    {
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= self::symbolByNum(rand(0, 128), $type);
        }
        return $randomString;
    }

    /**
     * Получить рандомную строку из 1 символа
     *
     * @param int $num - номер случайного символа
     * @param mixed $type - только числа ('num'), только буквы ('alpha') или любые символы (null)
     * @return string
     * */
    public static function symbolByNum($num, $type = null)
    {
        $numbers = '0123456789';
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $others  = '(){}[]!?|&@#$%*~';

        if (strpos($type, 'num') !== false) {
            $characters = $numbers;
        }
        if (strpos($type, 'alpha') !== false) {
            $characters = isset($characters) ? $characters . $letters : $letters;
        }
        if (!isset($characters)) {
            $characters = $numbers . $letters . $others;
        }
        while ($num >= strlen($characters)) {
            $characters .= $characters;
        }
        return $characters[$num];
    }

    /**
     * обрезание строки
     * @param string $string
     * @param int $length - количество символов от начала строки
     * @param string $after - строка, которую подставить после, если строка все-таки была обрезана
     * @return string
     * */
    public static function cutString($string, $length, $after = '...')
    {
        $return = trim(mb_substr($string, 0, $length));
        $return .= ($return == $string) ? '' : $after;
        return $return;
    }

    /**
     * обрезание строки, не обрезая слова
     * @param string $string
     * @param int $length - количество символов от начала строки
     * @param string $after - строка, которую подставить после, если строка все-таки была обрезана
     * @return string
     * */
    public static function cutStringByWord($string, $length, $after = '...')
    {
        if (mb_strlen($string) > $length) {
            $s     = mb_strtolower(mb_substr($string, 0, $length));
            $words = ArrayHelper::explodeX(array(' ', ',', '.', '?', '!', ')', '(', '-', '—'), $s, true);
            end($words);
            prev($words);
            if(is_null(key($words))) {
                return '';
            }
            $pos    = key($words) + mb_strlen($words[key($words)]);
            $return = trim(mb_substr($string, 0, $pos));
            $return .= ($return == $string) ? '' : $after;
        }
        else {
            $return = $string;
        }
        return $return;
    }

    /**
     * Find the position of the Xth occurrence of a substring in a string
     * @param string $haystack
     * @param $needle
     * @param integer $number
     * @return int
     */
    function strPosX($haystack, $needle, $number)
    {
        if ($number >= 1) {
            return ($number == 1) ? mb_strpos($haystack, $needle) : mb_strpos($haystack, $needle, self::strPosX($haystack, $needle, $number - 1) + mb_strlen($needle));
        }
        return -1;
    }
}