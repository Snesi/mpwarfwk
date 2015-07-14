<?php

namespace MPWAR;

class AppConfig
{
    private $config;

    private static $instance;

    protected function __construct()
    {
        $this->config = [];
    }

    public static function __callStatic($name, $arguments)
    {
        if(!isset(self::$instance)) {
            self::$instance = new AppConfig();
        }
        $instance = self::$instance;
        if(count($arguments) === 0) {
            return call_user_func_array([$instance, $name], $arguments);
        } else {
            call_user_func_array([$instance, $name], $arguments);
            return $instance;
        }
    }

    public function __call($name, $arguments)
    {
        if(count($arguments) === 0) {
            return $this->config[$name];
        }
        $this->config[$name] = $arguments[0];
    }

    public static function toArray() {
        if(!isset(self::$instance)) return [];
        return self::$instance->getConfig();
    }

    private function getConfig() {
        return $this->config;
    }
}
