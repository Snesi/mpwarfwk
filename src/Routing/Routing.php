<?php
namespace MPWAR\Routing;

use MPWAR\Routing\Route;
use MPWAR\Request\Request;
use Exceptions;

class Routing
{
    private $routes;

    public function __construct()
    {
        $this->routes = [];
        foreach (Route::$routes as $route) {
            $this->routes = array_merge($this->routes, $route->toArray());
        }
    }

    private function getMethodsForUrl($url, &$matches = null)
    {
        foreach ($this->routes as $url_regex => $methods) {
            if (preg_match_all($url_regex, $url, $matches)) {
                return $methods;
            }
        }
        return null;
    }

    private function methodExists($urlMethods, $method)
    {
        return isset($urlMethods[$method]);
    }

    public function getActionData(Request $req)
    {
        $urlMethods = $this->getMethodsForUrl($req->uri, $urlArgs);
        if ($this->methodExists($urlMethods, $req->method)) {
            $action = $urlMethods[$req->method];
            if (count($urlArgs)>1) {
                return [$action, $urlArgs[1]];
            } else {
                return [$action, []];
            }
        } else {
            throw new UndefinedUrlException("URL not found", 1);
        }
    }
}
