<?php

class DatetimeHelper
{
    /**
     * @var array короткие названия месяцев
     */
    private static $_shortMonth = array(
        '',
        'янв',
        'фев',
        'мар',
        'апр',
        'май',
        'июн',
        'июл',
        'авг',
        'сен',
        'окт',
        'ноя',
        'дек',
    );

    private static $_fullMonth = array(
        '',
        'января',
        'февраля',
        'марта',
        'апреля',
        'мая',
        'июня',
        'июля',
        'августа',
        'сентября',
        'октября',
        'ноября',
        'декабря',
    );

    public static function formatShort($timestamp, $withTime = false)
    {
        if(is_null($timestamp = self::_firstCheck($timestamp))) {
            return null;
        }
        $formattedDate = date('j ', $timestamp) . self::$_shortMonth[date('n', $timestamp)] . date('. Yг.', $timestamp);

        if ($withTime) {
            $formattedDate .= ', ' . date('H:i', $timestamp);
        }

        return $formattedDate;
    }

    public static function formatFull($timestamp, $withTime = false)
    {
        if(is_null($timestamp = self::_firstCheck($timestamp))) {
            return null;
        }
        $formattedDate = date('j ', $timestamp) . self::$_fullMonth[date('n', $timestamp)] . date(' Yг.', $timestamp);

        if ($withTime) {
            $formattedDate .= ', ' . date('H:i', $timestamp);
        }

        return $formattedDate;
    }

    /**
     * Возвращает количество лет со времени поданного времени
     * @param mixed $time
     * @return int|null
     * */
    public static function yearsFromNow($time)
    {
        if(is_null($time = self::_firstCheck($time))) {
            return null;
        }
        return abs((int)date('Y', (time() - $time)) - (int)date("Y-m-d H:i:s", 0));
    }

    public static function getDbDate($timestamp = null, $schema = 'Y-m-d H:i:s')
    {
        if(is_null($timestamp = self::_firstCheck($timestamp))) {
            Yii::log('Подан некорректный timestamp', CLogger::LEVEL_WARNING, 'app');
        }
        $timestamp = is_null($timestamp) ? time() : $timestamp;
        return date($schema, $timestamp);
    }

    public static function dateToTimestamp($date, $default = 0)
    {
        $time = strtotime($date);
        return ((!$time) || (int)date('Y', $time) < 0) ? $default : $time;
    }

    private static function _firstCheck($timestamp) {
        if (!is_int($timestamp) && (!($timestamp = strtotime($timestamp)) || (int)date('Y', $timestamp) < 0)) {
            $timestamp = null;
        }
        return $timestamp;
    }
}