<?php

namespace Firelink\Facades;

use Firelink\Http\Request;

class Route
{
    protected static array $routes = [];
    public static function get($uri, $action)
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function dispatch(Request $request)
    {
        $method =  $request->method();
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset(self::$routes[$method][$uri])) {
            http_response_code(404);
            echo "404 Not Found";
        }

        [$class, $action] = self::$routes[$method][$uri];

        $class = new $class();

        echo $class->$action();
        return;
    }
}