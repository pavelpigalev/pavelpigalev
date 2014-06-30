<?php

class MyController extends CController
{
    public $layout = '//layouts/column1';

    public $menu = array();

    public $breadcrumbs = array();

    /* @var $_app CWebApplication */
    protected $_app;

    public function init() {
        $this->_app = Yii::app();
        parent::init();
    }
}