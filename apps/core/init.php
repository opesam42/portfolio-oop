<?php
// initialization file

spl_autoload_register(function($classname) {
    $directories = [
        '../apps/models/',
        '../apps/misc/'
    ];

    foreach ($directories as $directory) {
        $filename = $directory . "{$classname}.php";
        if (file_exists($filename)) {
            require $filename;
            return true;
        }
    }
    // Optional: Return false if file not found, in case other autoloaders need to handle it
    return false;
});

require "config.php";
require "functions.php";
require "App.php";
require "ApiController.php";
require "Controller.php";
require "Database.php";
require "Model.php";