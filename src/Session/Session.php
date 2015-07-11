<?php
namespace MPWAR\Session;

class Session
{
    public function __construct()
    {
        session_start();
    }
    
    public function __get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function __set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
