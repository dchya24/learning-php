<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 

require_once __DIR__ . '/vendor/autoload.php';

use Core\Router;

$route = new Router;

$route->add('/home/url/{id}', ['controller' => 'HomeController', 'action' => 'index']);
$route->add('/home/url', ['controller' => 'HomeController', 'action' => 'index']);

$route->dispatch($_SERVER['REQUEST_URI']);

?>