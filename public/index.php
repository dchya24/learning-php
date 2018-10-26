<?php 


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Url.php';

define('BASE_URL',__DIR__);

/**
 * Error Reporting
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');



use Core\Router;
use Symfony\Component\Dotenv\Dotenv;
$data = explode('public', __DIR__);

$env = new Dotenv();
$env->load($data[0] . '.config');
// die(var_dump(url('css')));

$route = new Router;

$route->add('', ['controller' => 'HomeController', 'action' => 'index']);
$route->add('home/url', ['controller' => 'HomeController', 'action' => 'index']);

$route->dispatch($_SERVER['QUERY_STRING']);