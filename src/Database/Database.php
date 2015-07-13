<?php

namespace MPWAR\Database;

class Database
{
    const MYSQL = 'mysql';
    private static $databases = [];

    protected function __construct()
    {
    }

    public static function get($alias)
    {
        if (isset(self::$databases[$alias])) {
            return self::$databases[$alias];
        }

        return;
    }

    public static function mysql($alias)
    {
        $mysql = new RelationalDB(self::MYSQL);
        self::$databases[$alias] = $mysql;

        return $mysql;
    }

    // TODO: Implement Redis Database;
    public static function redis($alias)
    {
        $redis = new RedisDB();
        self::$databases[$alias] = $redis;

        return $redis;
    }
}
