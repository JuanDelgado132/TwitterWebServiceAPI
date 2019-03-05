<?php
namespace APIRequests;
class RegisterRequest {
    private $email;
    private $firstName;
    private $lastName;
    private $userName;
    private $password;
    private $picture;
    

    
    
    public function parseJson($jsonObject){
        $this->email = $jsonObject->{'email'};
        $this->firstName = $jsonObject->{'First Name'};
        $this->lastName = $jsonObject->{'Last Name'};
        $this->userName = $jsonObject->{'Username'};
        $this->password = $jsonObject->{'password'};
        $this->picture = $jsonObject->{'Profile Picture'};
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }
}







?>