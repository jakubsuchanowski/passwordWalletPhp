<?php 
require_once 'app/models/Password.php';
class PasswordController{
    private $password;
    public function __construct($ecnryption_key){
        $config=new Config();
        $conn=$config->connect();
        $this->password = new Password($conn);
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
    
        $passwords=$this->password->getPasswords($user_id);
        // var_dump($passwords);
        if(empty($passwords)){
            $_SESSION['error']="Nie udało się pobrać haseł. Brak haseł.";
            return [];
        }else{
            return $passwords;

        }

    }
    public function getPasswordById($password_id){
        $password=$this->password->findPasswordById($password_id);
        if(empty($password)){
            $_SESSION["error"]= "Nie udało się pobrać hasła.";
            return null;
        }else{
        return $password;
        }
    }

    public function editPassword($id,$website, $username, $password){
        if(empty($id)||empty($password)||empty($username)||empty($website)){
            $_SESSION['error']="Wszystkie pola są wymagane.";
            return;
        }
        
        error_log("Updating password for ID: $id, Website: $website, Username: $username");
        $result=$this->password->updatePassword($id,$website,$username,$password);
        if($result){
            var_dump($result);
            $_SESSION["success"]= "Hasło zaktualizowane.";
            header("Location: ?action=dashboard");
        }else{
            $_SESSION["error"]= "Nie udało zaktualizować hasła.";
        }
    }
}
?>