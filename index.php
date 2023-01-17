<?php

//Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Autoload file required
require_once('vendor/autoload.php');

//start session
session_start();

//Create instance of Base Class
$f3 = Base::instance();

//Create an instance of the Controller class
$controller = new AdviseItController($f3);

// Home/Default route
$f3->route('GET /', function(){
    $GLOBALS['controller']->home();
});

// Create Plan route
$f3->route('GET /CreatePlan', function(){
    $GLOBALS['controller']->CreatePlan();
});

// Plan Route
$f3->route('GET /plan@planid', function(\Base $f3, array $params){
    $GLOBALS['controller']->plan($params['planid']);
});

//Run fat free
$f3->run();