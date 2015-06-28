<?php
namespace MPWAR\Request;

class Request
{
	const URI_OFFSET = 1;
	const REQUEST_METHOD = "REQUEST_METHOD";
	const REQUEST_URI = "REQUEST_URI";
    
    private $get;
    private $post;
    private $server;
    private $cookies;
    private $uri;
    private $session;
    private $method;
    private $uri_components;

    
    public function __construct() {
        $this->createParameters();
        $this->processUri();
    }
    
    private function createParameters() {
        $this->get = new Parameters($_GET);
        $this->post = new Parameters($_POST);
        $this->server = new Parameters($_SERVER);
        $this->cookies = new Parameters($_COOKIE);
        
        $this->method = $_SERVER[self::REQUEST_METHOD];
        $this->uri = $_SERVER[self::REQUEST_URI];
    }

    private function processUri() {
    	$this->uri_components = array_slice(explode("/", $this->uri), self::URI_OFFSET);
    }

    public function __get($property) {
    	if(isset($this->$property)){
    		return $this->$property;
    	}
    	return null;
    }
}
