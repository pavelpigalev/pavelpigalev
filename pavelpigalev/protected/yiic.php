<?php

// change the following paths if necessary
$yiic = dirname(__FILE__) . '/../../framework/yiic.php';
if (file_exists(dirname(__FILE__) . '/config/console-local.php')) {
    $config = dirname(__FILE__) . '/config/console-local.php';
} elseif (file_exists(dirname(__FILE__) . '/config/console-production.php')) {
    $config = dirname(__FILE__) . '/config/console-production.php';
} else {
    $config = dirname(__FILE__) . '/config/console.php';
}

require_once($yiic);
