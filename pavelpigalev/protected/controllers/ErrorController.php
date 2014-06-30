<?php

class ErrorController extends MyController
{
    public function actionIndex()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('general', $error);
            }
        }
    }
}