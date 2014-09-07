<?php

class MainController extends MyController
{

    public function actionIndex()
    {
        $this->layout = '//layouts/index-layout';

        $this->_app->cache->delete('mainPageCache');

        $cache = $this->_app->cache->get('mainPageCache');

        if (!$cache) {
            $layers = array(
                array(
                    'type' => 'img',
                    'src'  => '/front/img/mountains-layers/back.png',
                ),
                array(
                    'type' => 'img',
                    'src'  => '/front/img/mountains-layers/middle-back.png',
                ),
                array(
                    'type' => 'html',
                    'src'  => '<div class="text text-left"><p class="big">PAVEL</p></div>',
                    'class' => 'text text-left',
                ),
                array(
                    'type' => 'img',
                    'src'  => '/front/img/mountains-layers/middle-front.png',
                    'class' => 'mountain',
                ),
                array(
                    'type' => 'html',
                    'src'  => '<div class="text text-right"><p class="small">WEB DEVELOPER</p><p class="big">PIGALEV</p></div>',
                ),
                array(
                    'type' => 'img',
                    'src'  => '/front/img/mountains-layers/front.png',
                ),
                array(
                    'type' => 'img',
                    'src'  => '/front/img/mountains-layers/over-layer.png',
                ),
            );
            $size   = getimagesize($this->_app->params['webRoot'] . '/front/img/mountains-layers/front.png');
            $cache  = array(
                'ratio'  => $size[1] / $size[0],
                'layers' => $layers
            );

            $this->_app->cache->set('mainPageCache', $cache);
        }

        $this->render('index',array(
            'layers' => $cache['layers'],
            'ratio' => $cache['ratio'],
        ));
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

    public function actionContact()
    {
        $this->render('contact');
    }
}