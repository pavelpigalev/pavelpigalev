<?php
$basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..';
return array(
    'basePath'   => $basePath,
    'name'       => 'PP Console App',
    'preload'    => array('log'),
    'import'     => array(),
    'components' => array(
        'db'  => array(),
        'log' => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
    'params'     => array(
        'webRoot' => $basePath . DIRECTORY_SEPARATOR . '..',
    )
);
