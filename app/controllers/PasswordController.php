<?php 
require_once 'app/crypto/Crypto.php';
require_once 'app/models/Password.php';
class PasswordController{
    private $password;
    private $crypto;
    public function __construct($ecnryption_key){
        $config=new Config();
        $conn=$config->connect();
        $this->crypto = new Crypto($ecnryption_key);
        $this->password = new Password($conn,$this->crypto);
    }

    public function add($website,$username,$password,$user_id){
        if(empty($password)||empty($username)||empty($website)){
            $_SESSION['error']="Wszystkie pola są wymagane.";
            return;
        }
        $result=$this->password->addPassword($website,$username,$password,$user_id);
        if($result){
            $_SESSION["success"]= "Hasło dodane pomyślnie.";
            header("Location: ?action=dashboard");
        }else{
            $_SESSION["error"]= "Nie udało się dodać hasła.";
        }
    }

    public function showPasswords($user_id){
        if(empty($user_id)){
            $_SESSION["error"]= "Nie można odnaleźć użytkownika.";
        }
    
        if($this->password->getPasswords($user_id)){
            $_SESSION["success"]= "Pobrano hasła.";
        }else{
            $_SESSION['error']="Nie udało się pobrać haseł.";
        }

    }
}
?>