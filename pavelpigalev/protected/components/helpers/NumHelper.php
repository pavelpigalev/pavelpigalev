<?php
/**
 * Класс-помощник, призванный производить нетривиальные манипуляции с числами
 */

class NumHelper {
    /**
     * склонение числительных
     * getDeclension(153, 'рубль, рубля, рублей')) -> вернет "рубля"
     * @param int $digit
     * @param mixed $forms
     * @return string
     */
    public static function getDeclension($digit, $forms)
    {
        if (!is_array($forms)) {
            $forms = explode(',', $forms);
            $forms = array_map('trim', $forms);
        }
        if (count($forms) < 2) {
            return $forms[0];
        }
        if (count($forms) < 3) {
            $forms[2] = $forms[1];
        }
        $cases = array(2, 0, 1, 1, 1, 2);
        return $forms[($digit % 100 > 4 && $digit % 100 < 20) ? 2 : $cases[min($digit % 10, 5)]];
    }
}