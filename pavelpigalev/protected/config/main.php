<?php
$basePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
return array(
    'basePath'=>$basePath,

    'name'=>'pavelpigalev.com',

    'defaultController' => 'main/index',

    'sourceLanguage'=>'ru',

    'preload'=>array('log'),

    'import'=>array(
        'application.components.*',
        'application.models.*',
    ),

    'modules'=>array(
        'admin'=> array(
            'defaultController' => 'index',
        ),
    ),

    'components'   => array(
        'user'       => array(
            'allowAutoLogin' => true,
            'class'          => 'MyCWebUser',
            'loginUrl'       => array('auth/login'),
            'guestName'      => 'Гость',
        ),

        'urlManager' => array(
            'urlFormat'      => 'path',
            'caseSensitive'  => false,
            'showScriptName' => false,
            'urlSuffix'      => '/',
            'rules'          => array(
                '<controller:\w+>/<id:\d+>'              => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
            ),
        ),

        'db' => array(),

        'search'     => array(),

        'cache'      => array(
            'class' => 'system.caching.CMemCache',
        ),


        'authManager'  => array(
            'class' => 'MyPhpAuthManager'
        ),

        'errorHandler' => array(
            'errorAction' => 'error',
        ),

        'log'          => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class'  => 'CProfileLogRoute',
                    'levels' => 'error, warning, trace, info, profile',
                ),
            ),
        ),
    ),
    'params'=>array(
        'adminEmail'=>'pavel.pigalev@gmail.com',
        'webRoot' => $basePath . DIRECTORY_SEPARATOR . '..',
        'debug' => false,
    ),
);
