<?php
namespace MPWAR\Request;

class Parameters
{
    private $params;
    public function __construct($params)
    {
        $this->params = $params;
    }
    public function __get($key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
        return null;
    }
    public function __set($key, $value)
    {
        $this->params[$key] = $value;
    }
}
