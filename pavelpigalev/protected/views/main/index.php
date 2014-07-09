<?php
/* @var $this MainController */

$this->pageTitle = $this->_app->name . ' | ' . (($this->_app->params['debug']) ? 'development' : 'production');

?>

<h1>Добро пожаловать на
    <u><?=(($this->_app->params['debug']) ? 'development' : 'production')?></u>
    версию сайта <i><?= CHtml::encode($this->_app->name); ?></i></h1>


<?
App::pr(Ip::instance()->getIp());
App::pr(Ip::instance()->getGeo());
?>