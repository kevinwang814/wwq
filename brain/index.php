<?php
//error_reporting(E_ALL);
//error_reporting(E_ALL ^ E_NOTICE);
define("APP_PATH", dirname(__FILE__) . '/app');
define('FW_PATH', '../_framework');
include FW_PATH . '/core.php';
$dispatcher = new Dispatcher_Site(APP_PATH . '/module');
$dispatcher->Run();
?>