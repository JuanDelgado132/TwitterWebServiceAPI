<?php

class User implements JsonSerializable{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $username;
    private $password;
    private $profilePicture;
    
    
    function __construct($id,$firstName, $lastName, $email, $username, $password, $profilePicture){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->profilePicture = $profilePicture;
    }
    public function getId(){
        return $this->id;
    }
    public function getFirstName(){
        return $this->firstName;
    }
    public function getLastName(){
        return $this->lastName;
    }
    public function getUserName(){
        return $this->username;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getProfilePicture(){
        return $this->profilePicture;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setUsername($userName){
        $this->username = $userName;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setProfile($profilePicture){
        $this->profilePicture = $profilePicture;
    }
    public function jsonSerialize(){
        return array('id' => $this->id, 'firstName' => $this->firstName, 'lastName' => $this->lastName, 'email' => $this->email, 'username' => $this->username, 'password' => $this->password, 'profilePicture' => $this->profilePicture);
    }
}
?>