<?php

namespace Core\Http;

use Core\Http\Request;
use Core\Http\Response;

class Route
{

    public Request $request;

    public Response $response;

    public function __construct(Request $request , Response $response){
        $this->request      = $request;
        $this->response     = $response;
    }

    public static array $routes = [];

    public static function get($route, callable|array|string $action)
    {
        self::$routes['get'][$route] = $action;
    }


    public static function post($route, callable|array|string $action)
    {
        self::$routes['post'][$route] = $action;
    }

    public function resolve(){

        $path       = $this->request->path();
        $method     = $this->request->method();

        $action     = self::$routes[$method][$path] ?? false;
        
        if(!$action){
            return ;
        }

        // 404 handling

        if(is_callable($action)){
            call_user_func_array($action , []);
        }
        if(is_array($action)){

            call_user_func_array([new $action[0] , $action[1]] , []);
        }
        if(is_string($action)){
            $newaction = explode('@' , $action);
            $controller = "App\\Controllers\\" . $newaction[0];
            call_user_func_array([new $controller(), $newaction[1]], []);
        }
    }
}