<?php
namespace MPWAR;

/**
 *
 */
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
    
    public function __construct($route, $method = self::GET) {
        $this->url = $route;
        $this->method = $method;
    }
    
    public static function get($route) {
        return new Route($route, self::GET);
    }
    
    public static function post($route) {
        return new Route($route, self::POST);
    }
    
    private function isValidTimeUnit($time_unit) {
        return $time_unit === self::DAYS ||
               $time_unit === self::HOURS ||
               $time_unit === self::MINUTES ||
               $time_unit === self::SECONDS ||
               $time_unit === self::MILLISECONDS;
    }

    public function expireAfter($time, $time_unit = self::MILLISECONDS) {
        if($this->isValidTimeUnit($time_unit)) {
            $this->expiration = $time * $time_unit;
        } else {
            $this->expiration = self::DEFAULT_EXPIRATION;
        }
        return $this;
    }
    
    public function execute($action) {
        list($action, $controller) = explode("@", $action);
        if (isset($action) && isset($controller)) {
            $this->action = $action;
            $this->controller = $controller;
        }
        return $this;
    }
    
    public function respondWith($responseType) {
        $this->responseType = $responseType;
        return $this;
    }
    
    public function toArray() {
        return [
            $this->url => [
                $this->method => [
                    'controller' => $this->controller, 
                    'action' => $this->action, 
                    'response' => $this->responseType, 
                    'expiration' => $this->expiration
                ]
            ]
        ];
    }
    
    public function __get($property) {
        if (isset($this->$property)) {
            return $this->$property;
        }
        return null;
    }
    public function __set($property, $value) {
        if (isset($this->$property)) {
            $this->$property = $value;
        }
        return null;
    }
}
