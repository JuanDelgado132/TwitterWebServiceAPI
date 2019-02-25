<?php


require("Database/DBOperations.php");
require("model/User.php");
$db = new DBOperations();
//We get the json string from the request
$jsonString = file_get_contents("php://input");
$jsonObject = json_decode($jsonString);
//Encrypt password
$password = password_hash($jsonObject->{'password'}, PASSWORD_BCRYPT);
//File where image will be stored.
$imageFile = "pictures/{$jsonObject->{'Username'}}-profile-pic.png";
$imageData = explode(',',$jsonObject->{"Profile Picture"});
//Open the file in writable mode to make the picture
$fileStream = fopen($imageFile, "w");
//Decode the base64 string
fwrite($fileStream, base64_decode($jsonObject->{'Profile Picture'}));
fclose($fileStream);
//Generate a random user_id.
$userId = Rand(0000000,9999999);

//Create user object
$newUser = new User($userId, $jsonObject->{'First Name'}, $jsonObject->{'Last Name'}, $jsonObject->{'email'}, $jsonObject->{'Username'}, $password, $imageFile);
$code = $db->registerUser($newUser);
//Send the result back to client.
$obj = json_encode($newUser);
echo $obj;
//echo json_encode(array_push($obj, "status" => 1));
//echo json_encode(array("status" => $code));

?>
