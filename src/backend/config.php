<?php
session_start();

header("Content-type: text/html; charset=utf-8");
header("X-Powered-By: ''");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf8', 'portuguese');

error_reporting(E_ALL);
error_reporting(0);

// $envPath = 'env.ini'; 
// $env = parse_ini_file($envPath);

// define('dbHOST', $env['host']);
// define('dbNAME', $env['dbname']);
// define('dbUSER', $env['user']);
// define('dbPASSWORD', $env['password']);

require '../src/class/Router.php';
$router = new Router();
