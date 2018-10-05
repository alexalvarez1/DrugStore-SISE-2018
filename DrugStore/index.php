<?php

require_once './Config.php';
require_once './Routes.php';

function __autoload($file) {
    // first i need to import any required class
    if (file_exists("./classes/$file.php")) {
        require_once "./classes/$file.php";
        // second i need to import parent controller
    } else if (file_exists("./App/Controllers/parent/$file.php")) {
        require_once "./App/Controllers/parent/$file.php";
        //  third i need to import any required controller
    } else if (file_exists("./App/Controllers/$file.php")) {
        require_once "./App/Controllers/$file.php";
        // fourth i need to import any required model
    } else if (file_exists("./App/Models/$file.php")) {
        require_once "./App/Models/$file.php";
        // fifth i need to import any required action
    } else if (file_exists("./App/Models/Actions/$file.php")) {
        require_once "./App/Models/Actions/$file.php";
    }
}
