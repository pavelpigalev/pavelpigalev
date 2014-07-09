<?php
/* @var $this MainController */

$this->pageTitle = $this->_app->name . '| ' . ($this->_app->params['debug']) ? 'development' : 'production';

?>

<h1>Добро пожаловать на <i><?= CHtml::encode($this->_app->name); ?></i></h1>