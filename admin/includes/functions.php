<?php

function __autoload($class){
    $class = strtolower($class);
   $the_path = INCLUDES_PATH . DS . "{$class}.php";
    if (file_exists($the_path)) {
        require_once($the_path);
    }else {
        die("This file {$the_path} was not found !!!");
    }
}
function redirect($location){
    header("Location: {$location}");
}
