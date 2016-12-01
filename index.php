<?php

$url_path = $_SERVER['REQUEST_URI'];
$document_root = $_SERVER['DOCUMENT_ROOT'];

define('ROOT_PATH', realpath(__DIR__) );

define('VENDOR_PATH', ROOT_PATH.'/vendor');
define('APP_PATH'   , ROOT_PATH.'/app');
define('PUBLIC_PATH', ROOT_PATH);

require 'app/start.php';