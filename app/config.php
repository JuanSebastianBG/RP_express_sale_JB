<?php
$folderpath = dirname($_SERVER['SCRIPT_NAME']);
$urlpath = $_SERVER['REQUEST_URI'];
$url = substr($urlpath, strlen($folderpath));
date_default_timezone_set('America/Bogota');

define('URL_PATH', $urlpath);
define('URL', $url);
define('DOMAIN', ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] );

// Credenciales para la base de datos
define('DB_HOSTNAME', $_ENV['DB_HOSTNAME'] );
define('DB_USERNAME', $_ENV['DB_USERNAME'] );
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] );
define('DB_NAME',     $_ENV['DB_NAME'] );