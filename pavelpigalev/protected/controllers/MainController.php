<?php

class MainController extends MyController
{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionAbout()
    {
        $this->render('about');
    }

    public function actionExperience()
    {
        $this->render('experience');
    }

    public function actionPortfolio()
    {
        $this->render('portfolio');
    }
}