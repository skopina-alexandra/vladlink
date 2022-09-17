<?php
require "vendor/autoload.php";
include "includes/autoloader.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$setupDb = new SetupDb();
$setupDb->createDatabase();
$setupDb->createCategoriesTable();

$categoryController = new CategoryController();
$categoryController->importCategoriesFromFile("categories.json");
