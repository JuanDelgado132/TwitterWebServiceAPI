<?php
namespace APIRequests;

class loginRequest {
    private $email;
    
    private $password;
    
    function __construct(){
        
    }
    
    public function parseJSON($jsonObject){
        $this->email = $jsonObject->{'loginName'};
        $this->password = $jsonObject->{'password'};
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
}


?>