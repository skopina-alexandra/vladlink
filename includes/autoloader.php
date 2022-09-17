<?php

function AutoLoader($className){
    $path = "classes/";
    $extension = ".php";
    $fullPath = $path . $className . $extension;

    if(!file_exists($fullPath)){
        return false;
    }

    include_once $fullPath;
}

spl_autoload_register("AutoLoader");