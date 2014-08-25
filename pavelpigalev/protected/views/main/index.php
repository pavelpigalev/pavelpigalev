<?php
/* @var $this MainController */

$this->pageTitle = $this->_app->name . ' | ' . (($this->_app->params['debug']) ? 'development' : 'production');
FrontHelper::o()->addLess('main');
?>

    <h1>Welcome to
        <u><?= (($this->_app->params['debug']) ? 'development' : 'production') ?></u>
        version of my site
    </h1>


<?
/*App::pr(Ip::instance()->getIp());
App::pr(Ip::instance()->getGeo());*/
?>