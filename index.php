<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include all utility and controller classes 
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

// parse the query string for the command, defaulting to the login page
$command = "login";
if (isset($_GET["command"]))
    $command = $_GET["command"];

// start the session 
if (isset($_SESSION)) {
    session_destroy();
    session_start();
}
   
$finance = new FinanceController($command);
$finance->run();

?>