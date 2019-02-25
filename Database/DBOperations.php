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
    
    function registerUser($user){
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
        catch(Exception $e){
            echo $e->getMessage();
            return -1;
        }
        return 1;
        
    }
    
}









?>