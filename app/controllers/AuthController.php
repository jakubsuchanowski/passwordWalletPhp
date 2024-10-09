<?php
require_once 'app/models/User.php';
require_once 'app/config/database.php';
require_once 'app/config/keys.php';
class AuthController{
    private $user;

    public function __construct(){
        session_start();
        $config= new Config();
        $conn=$config->connect();
        $this->user=new User($conn);
        }

    private function generateSalt(){
        return bin2hex(random_bytes(16));
    }
    private function encryptHMAC($password){ 
        $hash=hash_hmac('sha512',$password,PEPPER);
        return $hash;
    }

    private function encryptSHA512($password, $salt){
        $hash=hash('sha512',$password.$salt.PEPPER);
        return $hash;   
    }
    
    public function register($username, $password, $encryptMethod){
        // var_dump('Rejestracja rozpoczęta');
        if(empty($username) || empty($password)){
            $_SESSION['error'] = "Wszystkie pola są wymagane.";
            header("Location: ?action=register");
            exit();
        }
        if($encryptMethod==='HMAC'){
            $hashedPassword=$this->encryptHMAC($password);
            $result=$this->user->registerWithHMAC($username, $hashedPassword,$encryptMethod);
        }else if($encryptMethod==='Sha512'){
            $salt=$this->generateSalt();
            $hashedPassword=$this->encryptSHA512($password, $salt);
            $result=$this->user->registerWithSHA512($username, $hashedPassword,$encryptMethod,$salt);
        }
        
        if($result===true){
            $_SESSION['success']= "Rejestracja zakończona sukcesem.";
            header("Location: ?action=login");
            exit();
        }else{
            $_SESSION["error"] = $result;
            header("Location: ?action=register");
            exit();
        }
    }

    public function login($username,$password){
        if(empty($username) || empty($password)){
            $_SESSION['error'] = "Wszystkie pola są wymagane.";
            header("Location: ?action=login");
            exit();
        }
        $encryptMethod=$this->user->getEncryptMethodByUsername($username);
        if($encryptMethod=== "hmac"){
            $hashedPassword=$this->encryptHMAC($password);
            $result=$this->user->login($username, $hashedPassword);
        }
        if($encryptMethod==="sha512"){
            $salt=$this->user->getSalt($username);
            $hashedPassword=$this->encryptSHA512($password, $salt);
            $result=$this->user->login($username, $hashedPassword);
        }
        if ($result === true) {
            $_SESSION["username"] = $username; 

            $_SESSION["user_id"]= $this->user->getUserIdByUserName($username);
            header("Location: ?action=dashboard"); 
            exit(); 
        } else {
            $_SESSION['error'] = $result; 
            header("Location: ?action=login");
            exit();
        }
    }
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: ?action=login');
        exit();
    }


}
?>