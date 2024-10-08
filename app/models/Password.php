<?php
class Password{
    private $conn;
    private $crypto;
    public function __construct($db_conn, $crypto){
        $this->conn = $db_conn;
        $this->crypto= $crypto;
    }

    public function addPassword($website,$username,$password, $user_id){
        $sql="INSERT INTO passwords(website,login,password,user_id) VALUES(?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $website, $username, $password,$user_id);
        if($stmt->execute()){
            return "Hasło zostało dodane";
        }else{
            return "Błąd podczas dodawania hasła: ".$stmt->error;
        }
    }

    public function getPasswords($user_id){
        $sql="SELECT * FROM passwords WHERE user_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("s", $user_id);
        $stmt->execute();
        $passwords=$stmt->fetchAll();
        return $passwords;
    }
   
}
?>