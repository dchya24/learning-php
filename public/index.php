<?php 
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Url.php';
require_once __DIR__ . '/../core/config.php';

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

$route = new Router;

$route->add('dashboard', ['controller' => 'HomeController', 'action' => 'dashboard']);
$route->add('upload', ['controller' => 'HomeController', 'action' => 'upload']);

$route->add('login', ['controller' => 'LoginController', 'action' => 'login']);
$route->add('register', ['controller' => 'LoginController', 'action' => 'register']);
$route->add('api/post/login', ['controller' => 'LoginController', 'action' => 'postLogin']);
$route->add('api/post/register', ['controller' => 'LoginController', 'action' => 'postRegister']);

$route->add('api/post/upload', ['controller' => 'HomeController', 'action' => 'postUpload']);
$route->add('api/post/delete', ['controller' => "HomeController", "action" => "delete"]);

$route->add("logout", ["controller" => "HomeController", "action" => "logout"]);

$route->dispatch($_SERVER['QUERY_STRING']);