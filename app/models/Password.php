<?php
require_once 'app/config/keys.php';
class Password{
    private $conn;

    public function __construct($db_conn){
        $this->conn = $db_conn;
    }
    private function encryptPassword($password) {
        return openssl_encrypt($password, 'AES-256-CBC', AES_KEY, 0, AES_IV);
    }

    private function decryptPassword($encryptedPassword) {
        return openssl_decrypt($encryptedPassword, 'AES-256-CBC', AES_KEY, 0, AES_IV);
    }

    public function addPassword($website,$username,$password, $user_id){
        $encryptedPassowrd=$this->encryptPassword($password);
        $sql="INSERT INTO passwords(website,login,password,user_id) VALUES(?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $website, $username,$encryptedPassowrd,$user_id);
        if($stmt->execute()){
            return "Hasło zostało dodane";
        }else{
            return "Błąd podczas dodawania hasła: ".$stmt->error;
        }
    }

    public function getPasswords($user_id){
        $sql="SELECT * FROM passwords WHERE user_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $passwords = [];
        while ($row = $result->fetch_assoc()) {
            $passwords[] = $row;
        }
        return $passwords; 
    }

    public function findPasswordObjectById($id){
        $sql= "SELECT * FROM passwords WHERE id=?";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updatePassword($id,$website, $username, $password){
        $encryptedPassword=$this->encryptPassword($password);
        $sql= "UPDATE passwords SET website=?,login=?,password=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi",$website,$username,$encryptedPassword, $id);
        if($stmt->execute()){
            return true;
        }else{return false;}
    }

    public function delete($id){
        $sql="DELETE FROM passwords WHERE id=?";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("i",$id);
        
        if($stmt->execute()){
            return true;
        }else{return false;}
    }

    public function getDecryptPassword($hashedPassword){
        $decryptedPassword=$this->decryptPassword($hashedPassword);
        return $decryptedPassword;
    }
   
}
?>