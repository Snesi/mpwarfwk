<?php

namespace MPWAR\Database;

use PDO;

class RelationalDB
{
    private $driver;
    private $host;
    private $database;
    private $user;
    private $password;
    private $pdo;

    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function host($host)
    {
        $this->host = $host;

        return $this;
    }
    public function database($database)
    {
        $this->database = $database;

        return $this;
    }
    public function user($user)
    {
        $this->user = $user;

        return $this;
    }
    public function password($password)
    {
        $this->password = $password;

        return $this;
    }

    public function isConfigured()
    {
        return isset($this->host) && isset($this->database) &&
            isset($this->user) && isset($this->password);
    }

    private function db()
    {
        if (!$this->isConfigured()) {
            throw new Exceptions\DBException('database is not configure correctly');
        }
        if (isset($this->pdo)) {
            return $this->pdo;
        }
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        try {
            $this->pdo = new PDO("$this->driver:host=$this->host;dbname=$this->database",
                $this->user, $this->password, $options);

            return $this->pdo;
        } catch (\PDOException $e) {
            throw new Exceptions\DBException("Couldn't connect to the database");
        }
    }
    public function close()
    {
        $this->pdo = null;
    }

    public function runQuery($sql, $data = null)
    {
        $pdo = $this->db();
        $sth = $pdo->prepare($sql);
        $sth->execute($data);

        return $sth->fetchAll();
    }
}
