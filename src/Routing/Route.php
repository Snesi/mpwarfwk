<?php
namespace MPWAR\Routing;

use MPWAR\Utils\Url;

class Route
{
    const GET = "GET";
    const POST = "POST";
    const MINUTES = 60000;
    const SECONDS = 1000;
    const HOURS = 3600000;
    const MILLISECONDS = 1;
    const DAYS = 86400000;

    const DEFAULT_EXPIRATION = 500;
    
    private $url;
    private $method;
    private $expiration;
    private $action;
    private $controller;
    private $responseType;

    public static $routes = [];
    
    public function __construct(Url $url, $method = self::GET)
    {
        $this->url = $url;
        $this->method = $method;
    }
    
    public static function get($route)
    {
        $url = new Url($route);
        $route = new Route($url, self::GET);
        self::$routes[] = $route;
        return $route;
    }
    
    public static function post($route)
    {
        $url = new Url($route);
        $route = new Route($url, self::POST);
        self::$routes[] = $route;
        return $route;
    }
    
    private function isValidTimeUnit($time_unit)
    {
        return $time_unit === self::DAYS ||
               $time_unit === self::HOURS ||
               $time_unit === self::MINUTES ||
               $time_unit === self::SECONDS ||
               $time_unit === self::MILLISECONDS;
    }

    public function expireAfter($time, $time_unit = self::MILLISECONDS)
    {
        if ($this->isValidTimeUnit($time_unit)) {
            $this->expiration = $time * $time_unit;
        } else {
            $this->expiration = self::DEFAULT_EXPIRATION;
        }
        return $this;
    }

    public function where($param, $pattern)
    {
        $this->url->addPattern($param, $pattern);
        return $this;
    }
    
    public function execute($action)
    {
        list($action, $controller) = explode("@", $action);
        if (isset($action) && isset($controller)) {
            $this->action = $action;
            $this->controller = $controller;
        }
        return $this;
    }
    
    public function respondWith($responseType)
    {
        $this->responseType = $responseType;
        return $this;
    }

    public function toArray()
    {
        $url_regex = $this->url->convertToRegex();
        return [
            $url_regex => [
                $this->method => [
                    'controller' => $this->controller,
                    'action' => $this->action,
                    'response' => $this->responseType,
                    'expiration' => $this->expiration
                ]
            ]
        ];
    }
    public function __get($property)
    {
        if (isset($this->$property)) {
            return $this->$property;
        }
        return null;
    }
    public function __set($property, $value)
    {
        if (isset($this->$property)) {
            $this->$property = $value;
        }
        return null;
    }
}
