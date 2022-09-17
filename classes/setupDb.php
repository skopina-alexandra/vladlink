<?php 

class SetupDb extends Db {

    public function createDatabase(){
        $sql = "CREATE DATABASE " . $_ENV["DB_NAME"];
        $pdo = $this->connectWithoutDB();
        if ($pdo->query($sql)){
            echo "Database created\n";
        } else {
            exit("Failed to create database: " . $pdo->errorInfo() . "\n");
        }
    }

    public function createCategoriesTable(){
        $sql = "CREATE TABLE categories (
            id INT PRIMARY KEY,
            parent_id INT NOT NULL DEFAULT '0',
            name VARCHAR(200) NOT NULL,
            alias VARCHAR(200) NOT NULL
            );
        ";
        $pdo = $this->connect();
        if ($pdo->query($sql)){
            echo "Successfully created table categories \n";
        } else {
            exit("Failed to create table categories: " . $pdo->errorInfo());
        }
    }
}