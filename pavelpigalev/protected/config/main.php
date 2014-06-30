<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$basePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';
return array(
    'basePath'=>$basePath,

    'name'=>'pavelpigalev.com',

    'defaultController' => 'site/index',

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

        //  local database
        'db'         => array(
            'connectionString'      => 'mysql:host=localhost;dbname=pp',
            'emulatePrepare'        => true,
            'username'              => 'root',
            'password'              => 'mysqlpassword',
            'charset'               => 'utf8',
            'class'                 => 'MyCDbConnection',
            'schemaCachingDuration' => 86400
        ),

        'search'     => array(
            'class'        => 'application.lib.DGSphinxSearch.DGSphinxSearch',
            'server'       => '127.0.0.1',
            'port'         => 3312,
            'maxQueryTime' => 3000,
        ),

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
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        'adminEmail'=>'pavel.pigalev@gmail.com',
        'webRoot' => $basePath . DIRECTORY_SEPARATOR . '..',
        'environment' => 'production',
    ),
);
