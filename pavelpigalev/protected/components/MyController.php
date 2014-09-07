<?php

class MyController extends CController
{
    public $layout = '//layouts/main';

    public $menu = array();

    public $breadcrumbs = array();

    /* @var $_app CWebApplication */
    protected $_app;

    public function init() {
        $this->_app = Yii::app();
        parent::init();
    }

    public function missingAction($actionID)
    {
        throw new CHttpException(404,Yii::t('yii','Page "{action}" was not found.',
            array('{action}'=>$actionID==''?$this->defaultAction:$actionID)));
    }
}