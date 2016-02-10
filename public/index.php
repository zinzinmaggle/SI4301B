<?php

if (isset($_SERVER["HTTPS"])
) {
    ini_set("session.cookie_secure", 1);
}

error_reporting(-1);
if (defined('E_DEPRECATED')) {
    error_reporting(E_ALL & ~(E_DEPRECATED | E_NOTICE | E_STRICT));
} else {
    error_reporting(E_ALL & ~E_NOTICE);
}

define("ENV", "PROD");
define("DS", '/');
define("ZEND_LIBRARY", dirname(__FILE__).DS.'..'.DS.'library'.DS);
define("APP_PATH", dirname(__FILE__).DS.'..'.DS.'application'.DS);
define("SWIFT_LIBRARY", dirname(__FILE__).DS.'..'.DS.'library'.DS);

$app = new Yaf\Application(APP_PATH."conf/application.ini");
Predis\Autoloader::register();

$app->bootstrap()->run();

