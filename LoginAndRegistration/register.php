<?php
use TwitterUser\User;
use APIRequests\RegisterRequest;
// TODO Model validation required using regex.
require ("database/DBOperations.php");
require ("model/User.php");
require("APIModels/RegisterRequest");

$db = new DBOperations();
$message = null;
// We get the json string from the request
$jsonString = file_get_contents("php://input");
$jsonObject = json_decode($jsonString);
//Create request object and parse the JSON
$request = new RegisterRequest();
$request->parseJson($jsonObject);
// Encrypt password
$password = password_hash($request->getPassword(), PASSWORD_BCRYPT);
// File where image will be stored.
$imageFile = "pictures/{$request->getUserName()}-profile-pic.png";
$imageData = explode(',', $request->getPicture());
// Open the file in writable mode to make the picture
$fileStream = fopen($imageFile, "w");
// Decode the base64 string
fwrite($fileStream, base64_decode($request->getPicture()));
fclose($fileStream);
// Generate a random user_id.
$userId = Rand(0000000, 9999999);
// Create user object
$newUser = new User($userId, $request->getFirstName(), $request->getLastName(), $request->getEmail(), $request->getUserName(), $password, $imageFile);
// Regiser user to db.
$code = $db->registerUser($newUser, $message);
// Send the result back to client.
$response = null;
if ($code == 1) {
    $response = array(
        "code" => $code,
        "user" => $newUser
    );
} else {
    $response = array(
        "code" => $code,
        "error" => $message
    );
}
echo json_encode($response);
?> 
