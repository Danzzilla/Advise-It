<?php
include "functions.php";

//Error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

$data = json_decode(file_get_contents('php://input'));

var_dump($_POST);

Functions::sendToDatabase($data);
Functions::removeDeleted($data);
