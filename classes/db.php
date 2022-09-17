<?php

class Db {
    private $serverName;
    private $user;
    private $password;
    private $dbName;

    function __construct()
    {
        $this->serverName = $_ENV["MYSQL_SERVERNAME"];
        $this->user = $_ENV["MYSQL_USER"];
        $this->password = $_ENV["MYSQL_PASSWORD"];
        $this->dbName = $_ENV["DB_NAME"];
    }

    protected function connect(){
        $dsn = "mysql:host=" . $this->serverName . ";dbname=" . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

    protected function connectWithoutDB(){
        $dsn = "mysql:host=" . $this->serverName;
        $pdo = new PDO($dsn, $this->user, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}