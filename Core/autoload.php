<?php

function my_autoloader($file)
{

    // if(strpos($file , 'Model') != false) {
    //     $file = substr($file , 11);
    // }
    
    $file = str_replace("\\", DIRECTORY_SEPARATOR, $file) . ".php";

    if (file_exists($file)) {
        include $file;
        return;
    }

    $file = "src\\" . $file;

    if (file_exists($file)) {
        
        include $file;
        return;
    } else {
        echo "error";
    }
}

spl_autoload_register('my_autoloader');
