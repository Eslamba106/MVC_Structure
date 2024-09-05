<?php 
use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Route;


require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ .'/../routes/web.php';
// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';
$route = new Route(new Request , new Response);

$route->resolve();