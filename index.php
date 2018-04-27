<?php

    include_once 'helpers.php';
    require_once 'config.php';

    spl_autoload_register(function($class){
        if(file_exists("libs/{$class}.php")){
            require_once "libs/{$class}.php";
        }
    });
    
    (new Router())->route();
?>
