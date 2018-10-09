<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$route = new Router;
die(var_dump($_SERVER['REQUEST_URI']));
$route->add('/home/url/{id}', ['controller' => 'HomeController', 'action' => 'index']);
$route->add('/home/url', ['controller' => 'HomeController', 'action' => 'index']);

$route->dispatch($_SERVER['REQUEST_URI']);

