<?
return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'db' => array(
                'connectionString'      => 'mysql:host=localhost;dbname=new_cosmo',
                'emulatePrepare'        => true,
                'username'              => 'root',
                'password'              => 'eechairi',
                'charset'               => 'utf8',
                'class'                 => 'MyCDbConnection',
                'schemaCachingDuration' => 86400,
                'enableProfiling'       => true,
                'enableParamLogging'    => true,
            ),
        ),
        'params'     => array()
    )
);