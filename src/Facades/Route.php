<?php

namespace Firelink\Facades;

use Firelink\Http\Request;
use Firelink\Http\Response;

class Route
{
    protected static array $routes = [];

    public static function get($uri, $action)
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action)
    {
        self::$routes['POST'][$uri] = $action;
    }

    public static function put($uri, $action)
    {
        self::$routes['PUT'][$uri] = $action;
    }

    public static function patch($uri, $action)
    {
        self::$routes['PATCH'][$uri] = $action;
    }

    public static function delete($uri, $action)
    {
        self::$routes['DELETE'][$uri] = $action;
    }

    public static function dispatch(Request $request, Response $response)
    {
        $method =  $request->method();
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset(self::$routes[$method][$uri])) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        [$class, $action] = self::$routes[$method][$uri];

        $class = new $class();

        echo $class->$action($request, $response);
        return;
    }
}