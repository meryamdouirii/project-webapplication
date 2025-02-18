<?php 

namespace App\controllers;


class HomeController 
{
    private $userService;
    private $homepageService;
    private $eventService;

    function __construct(){
        $this->userService = new \App\Services\UserService();
        $this->homepageService = new \App\Services\HomepageService();
        $this->eventService = new \App\Services\EventService();
    }

    public function index() {
        $events = $this->eventService->getAll();

        $homepage = $this->homepageService->getById(1);
        require("../views/index.php");
    }
   
    public function login(){
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            require("../views/user/login.php");
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $user = $this->userService->getByEmail($email);
            if ($user != null  && password_verify($password, $user->hashed_password) ) {
                $_SESSION['user'] = $user;
                $this->index();
            } else {
                require __DIR__ . '/../views/user/login.php';
            }
        }

        
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            require("../views/user/register.php");
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = htmlspecialchars($_POST['email']);
            $raw_password = htmlspecialchars($_POST['password']);
            $password = password_hash($raw_password, PASSWORD_DEFAULT);
            $type_of_user = \App\Models\enums\UserType::Customer;
            $first_name = !empty($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : null;
            $last_name = !empty($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : null;
            $phone_number = !empty($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : null;

            if ($this->userService->getByEmail($email) !== null) {
                $error = "This email is already registered.";
    
                $formData = $_POST;
    
                require __DIR__ . '/../views/user/register.php';
                exit;
            }

            $user = new \App\Models\User();
            $user->email = $email;
            $user->hashed_password = $password;
            $user->type_of_user = $type_of_user;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->phone_number = $phone_number;
            $user->salt= "salt";

            $this->userService->insert($user);

            
            $_SESSION['user'] = $user;
            $this->index();
        }
        
    }

    public function logout(){
        session_unset();  
        session_destroy();  

        header("Location: /");
        exit;
    }

    public function resetPassword(){
        require("../views/user/resetPassword.php");
    }

}


?>