<?php
namespace MPWAR\Request;

use \MPWAR\AppConfig;

class Request
{
    const URI_OFFSET = 1;
    const REQUEST_METHOD = "REQUEST_METHOD";
    const REQUEST_URI = "REQUEST_URI";
    const QUERY_START = "?";
    const HTTP_ACCEPT = "HTTP_ACCEPT";
    const JSON_CONTENT = "application/json";
    const LANGUAGE = "HTTP_ACCEPT_LANGUAGE";

    private $get;
    private $post;
    private $server;
    private $cookies;
    private $uri;
    private $session;
    private $method;
    private $uri_components;
    private $locale;


    public function __construct()
    {
        $this->createParameters();
    }

    private function createParameters()
    {
        $this->get = new Parameters($_GET);
        $this->post = new Parameters($_POST);
        $this->server = new Parameters($_SERVER);
        $this->cookies = new Parameters($_COOKIE);

        $this->locale = explode("-", $_SERVER[self::LANGUAGE])[0];
        if(!in_array($this->locale, AppConfig::locales())) {
            $this->locale = AppConfig::defaultLocale();
        }

        $this->method = $_SERVER[self::REQUEST_METHOD];
        $this->uri = $this->processUri($_SERVER[self::REQUEST_URI]);
    }

    private function processUri($request_uri)
    {
        return strtok($request_uri, self::QUERY_START);
    }

    public function isJson()
    {
        return $this->server->HTTP_ACCEPT === self::JSON_CONTENT;
    }

    public function __get($property)
    {
        if (isset($this->$property)) {
            return $this->$property;
        }
        return null;
    }
}
