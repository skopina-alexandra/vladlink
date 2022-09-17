<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

include "includes/autoloader.php";

$categoryView = new CategoryView();
$categoryView->exportCategoriesToFile("type_a.txt");
$categoryView->exportCategoriesToFile("type_b.txt", false, 1);
