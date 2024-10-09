<?php
class User{
    private $conn;

    public function __construct($db_conn){
        $this->conn = $db_conn;
    }

    public function registerWithHMAC($username, $password, $encryptMethod){
        if($this->isUserExist($username)){
            return "Użytkownik o tym loginie już istnieje.";
        }else
        $sql="INSERT INTO users(username,password,encryption_method) values(?,?,?)";
        $stmt= $this->conn->prepare($sql);
        $stmt->bind_param("sss",$username, $password,$encryptMethod);
        if($stmt->execute()){
            return true;
        }else {
            return "Błąd podczas rejestracji: " .$stmt->error;
        }
    }
    public function registerWithSHA512($username, $password, $encryptMethod,$salt){
        if($this->isUserExist($username)){
            return "Użytkownik o tym loginie już istnieje.";
        }else
        $sql="INSERT INTO users(username,password,encryption_method,salt) values(?,?,?,?)";
        $stmt= $this->conn->prepare($sql);
        $stmt->bind_param("ssss",$username, $password,$encryptMethod,$salt);
        if($stmt->execute()){
            return true;
        }else {
            return "Błąd podczas rejestracji: " .$stmt->error;
        }
    }

    public function login($username, $inputPassword){
        $stmt=$this->conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result=$stmt->get_result();
        if($result->num_rows===1 ){
            $user = $result->fetch_assoc();
            var_dump(hash_equals($user['password'],$inputPassword));
            if(hash_equals($user['password'],$inputPassword)){
                return true;
        } else{
            return "Nieprawidłowe hasło.";
        }
    }else {
        return "Użytkownik nie istnieje.";
    }
}

    public function getUserIdByUsername($username){
        $sql="SELECT id FROM users WHERE username=?";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $user = $result->fetch_assoc();
            return $user["id"];
        }else{
            return null;
        }
    }



public function isUserExist($username){
    $stmt=$this->conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows <1){
        return false;
    }else{
        return true;
    }
}
public function getEncryptMethodByUsername($username){
    $sql="SELECT encryption_method FROM USERS WHERE username=?";
    $stmt=$this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows ===1){
        $user= $result->fetch_assoc();
        return $user["encryption_method"];
    }else {
        return null;
    }
}
public function getSalt($username){
    $sql= "SELECT salt from users where username=?";
    $stmt=$this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows === 1){
        $user= $result->fetch_assoc();
        return $user["salt"];
    }
}
}

?>