<?php
require '../src/backend/config.php';

$handle = $router->handleRoute($_GET['url']);

$loader = $handle['loader'];
$view   = $handle['view'] ;

require $loader;

