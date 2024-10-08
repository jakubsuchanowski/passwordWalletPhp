<?php
require_once 'app/models/User.php';
require_once 'app/config.php';
class AuthController{
    private $user;

    public function __construct(){
        session_start();
        $config= new Config();
        $conn=$config->connect();
        $this->user=new User($conn);
        }

    public function register($username, $password){
        if(empty($username) || empty($password)){
            $_SESSION['error'] = "Wszystkie pola są wymagane.";
            header("Location: ?action=register");
            exit();
        }
        $result= $this->user->register($username,$password);
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
        $result= $this->user->login($username,$password);
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