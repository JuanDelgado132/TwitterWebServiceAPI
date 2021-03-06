<?php

final class DBOperations{
    private $host = "localhost";
    private $user = "id8584875_root";
    private $pass = "Comput3r!";
    private $database = "id8584875_twitter";
    
    function __construct(){}
    private function establishConnection(){
        $conn=null;
        try {
            
            $conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->pass);
            
            $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
        } catch(PDOException $e) {
            
            echo "connection failed: " . $e->getMessage();
        }
        
        return $conn;
    }
    
    function registerUser($user, &$message){
        $conn = $this->establishConnection();
        $userSQL = "INSERT INTO users(user_id,first_name,last_name,email,username,password,profile_picture)VALUES(:ID,:First,:Last,:Email,:Username,:Pass,:Pic);";
        $picSQL = "INSERT INTO pictures(user_id,picture_path)VALUES(:ID,:Pic);";
        $stmt = $conn->prepare($userSQL);
        $picStmt = $conn->prepare($picSQL);
        $id = $user->getId();
        $first = $user->getFirstName();
        $last = $user->getLastName();
        $email = $user->getEmail();
        $username = $user->getUsername();
        $pass = $user->getPassword();
        $pic = $user->getProfilePicture();
        $stmt->bindParam(':ID',$id,PDO::PARAM_INT);
        $stmt->bindParam(':First',$first);
        $stmt->bindParam(':Last',$last);
        $stmt->bindParam(':Email',$email);
        $stmt->bindParam(':Username',$username);
        $stmt->bindParam(':Pass',$pass);
        $stmt->bindParam(':Pic',$pic);
        $picStmt->bindParam(':ID',$id,PDO::PARAM_INT);
        $picStmt->bindParam(':Pic',$pic);
        
        try {
            $stmt->execute();
            $picStmt->execute();
        }
        catch(PDOException $e){
            $message = $this->translateCode($e->getCode());
            
           return -1;
        }
        return 1;
        
    }
    
    function getUser($loginName, $password, &$user){
        $conn = $this->establishConnection();
        $sql = "SELECT * FROM users WHERE email = :EMAIL AND password = :PASSWORD";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":EMAIL", $loginName, PDO::PARAM_STR);
        $stmt->bindParam(":PASSWORD", $password, PDO::PARAM_STR);
        $results = $stmt->fetchAll();
        if($results != null){
            
        }
    }
    function translateCode($code){
        switch ($code){
            case 23000:
                return "An account with that email already exists please choose another";
            default:
                return "ERROR, something went wrong.";
        }
    }
    
}









?>