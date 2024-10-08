<?php
class User{
    private $conn;

    public function __construct($db_conn){
        $this->conn = $db_conn;
    }

    public function register($username, $password){
        if($this->isUserExist($username)){
            return "Użytkownik o tym loginie już istnieje.";
        }else
        $passwordHash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO users(username,password) values(?,?)";
        $stmt= $this->conn->prepare($sql);
        $stmt->bind_param("ss",$username, $passwordHash);
        if($stmt->execute()){
            return true;
        }else {
            return "Błąd podczas rejestracji: " .$stmt->error;
        }
    }

    public function login($username, $password){
        $stmt=$this->conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result=$stmt->get_result();
        if($result->num_rows===1 ){
            $user = $result->fetch_assoc();
            if(password_verify($password, $user['password'])){
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
}

?>