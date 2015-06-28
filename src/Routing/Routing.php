<?php
namespace MPWAR\Routing;

use MPWAR\Routing\Route;

class Routing
{
    
    private $routes;
    
    public function __construct() {
        $this->routes = [];
        foreach (Route::$routes as $route) {
            $this->routes = array_merge($this->routes, $route->toArray());
        }
    }

    private function urlHasAction($url) {
    	return isset($this->routes[$url]) && isset($this->routes[$url][$method]);
    }
    
    public function getAction($url, $method)
    {
        if ($this->urlHasAction($url)) {
            $action = $this->routes[$url][$method];
        } else {
        	throw new Exception("URL not found", 1);
        }
    }
}
