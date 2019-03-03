<?php
use APIRequests\LoginRequest;

require("database/DBOperations.php");
require("model/User.php");
//Get database object
$db = new DBOperations();

//We get the json string from the request
$jsonString = file_get_contents("php://input");
$jsonObject = json_decode($jsonString);
$request = new LoginRequest();

$request->parseJSON($jsonObject);

$db.getUser($request->getEmail(), $request->getPassword());
?>
