<?php
// session_start();
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/PasswordController.php';
$encryption_key = 'klucz_szyfrowania';
$controller=new AuthController();
$passwordController=new PasswordController($encryption_key);
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : null;
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : null;

// Wyczyść komunikaty po wyświetleniu
unset($_SESSION['error']);
unset($_SESSION['success']);
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_GET['action'])){
        switch($_GET['action']){
            case 'register':
                $username=$_POST['username'];
                $password=$_POST['password'];
                $encryptMethod=$_POST['encryptOption'];
                $controller->register($username,$password,$encryptMethod);
                break;
            case 'login':
                $username=$_POST['username'];
                $password=$_POST['password'];
                $controller->login($username,$password);
                break;
            case 'logout':
                $controller->logout();
                break;
            case 'addPassword':
                $website=$_POST['website'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $user_id=$_SESSION['user_id'];
                $passwordController->add($website, $username, $password, $user_id);
                break;
            case 'updatePassword':
                $id=$_POST['id'];
                $website=$_POST['website'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $passwordController->editPassword( $id, $website,$username, $password);
                break;
            case 'deletePassword':
                $id=$_GET['id'];
                $passwordController->deletePassword($id);
                break;
            case 'showPassword':
                $_SESSION['showPassword'][$_GET['id']] = true;
                $id=$_GET['id'];
                var_dump($_SESSION['showPassword'][$id]);
                header("Location: ?action=dashboard");
                
                // $passwordController->showDecryptedPassword( $id );
                break;
            case 'hidePassword':
                $_SESSION['showPassword'][$_GET['id']] = false;
                $id=$_GET['id'];
                var_dump($_SESSION['showPassword']['id']);
                header("Location: ?action=dashboard");
                // $passwordController->showEncryptedPassword( $id );
                break;
        }
    }
}else{
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'register':
                    include 'app/views/register.php';
                    break;
                case 'login':
                    include 'app/views/login.php';
                    break;
                case 'dashboard':
                    if (isset($_SESSION['username']) &&  isset($_SESSION['user_id'])) {
                        $user_id=$_SESSION['user_id'];
                        $passwords=$passwordController->showPasswords($user_id);
                        include 'app/views/dashboard.php';

                    }else{
                        header('Location:?action=login');
                        exit();
                    }
                    break;
                case 'addPassword':
                    include 'app/views/addPassword.php';
                    break;
                case 'updatePassword':
                    $passwordId=$_GET['id'];
                    $password=$passwordController->getPasswordById($passwordId);
                    include 'app/views/updatePassword.php';
                    break;
            }
        }else{
        include 'app/views/login.php';
    }
}
?>