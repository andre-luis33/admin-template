<?php
session_start();


header("Content-type: text/html; charset=utf-8");
header("X-Powered-By: ''");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf8', 'portuguese');

error_reporting(E_ALL);
error_reporting(0);

$envPath = 'env.ini'; 
$env = parse_ini_file($envPath);

define('dbHOST', $env['host']);
define('dbNAME', $env['dbname']);
define('dbUSER', $env['user']);
define('dbPASSWORD', $env['password']);

define('SPA_AUTH_KEY', 'g24Kw!2#BN0fAfMj89');

define('JS_PAGES_PATH', 'assets/js/pages/');
define('CACHE_PATH', '../src/cache/');

require '../src/utils/components.php';
require '../src/utils/functions.php';

require '../src/class/Router.php';
require '../src/class/Cache.php';
require '../src/class/Database.php';
require '../src/class/Customers.php';
require '../src/class/Offices.php';


$router = new Router();

