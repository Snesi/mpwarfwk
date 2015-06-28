<?php
namespace MPWAR;

/**
 *
 */
class Route
{
    const GET = "GET";
    const POST = "POST";
    const MINUTES = "minutes";
    const SECONDS = "seconds";
    const HOURS = "hours";
    const MILLISECONDS = "milliseconds";
    const DAYS = "days";
    
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
    
    public function expireAfter($time, $time_unit = self::MILLISECONDS) {
        if ($time_unit == self::MILLISECONDS) {
            $this->expiration = $time;
        } 
        else {
            $this->expiration = $time;
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
