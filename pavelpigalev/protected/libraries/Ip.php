<?php
include('include/ip/geoipcity.inc');

class Ip
{
    private static $_instance = null;
    private $_ip = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function getIp()
    {
        if (is_null($this->_ip)) {
            $this->_ip = $this->_getRealIpAddr();
        }
        return $this->_ip;
    }

    public function getGeo() {
        $gi     = geoip_open(Yii::app()->params['pathToLib'] . "/include/ip/GeoLiteCity.dat", GEOIP_STANDARD);
        $record = geoip_record_by_addr($gi, $this->getIp()); // 206.130.100.140 - проверка
        if (is_null($record)) {
            return new geoiprecord();
        }
        return $record;
    }

    private function _getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}


