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
            $salt = $user->salt;
            if ($user != null  && password_verify(($password.$salt), $user->hashed_password) ) {
                $_SESSION['user'] = $user;
                $this->index();
            } else {
                return $this->showError("Invalid email or password!", $_POST);
            }
        }

        
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD']=="GET"){
            require("../views/user/register.php");
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $recaptcha_secret = "6LdJ6NoqAAAAAG1yuZ0FjAYrk0W0Art77jCau0Ev"; 
            $recaptcha_response = $_POST['g-recaptcha-response'];
        
            // Verify reCAPTCHA response with Google
            $verify_url = "https://www.google.com/recaptcha/api/siteverify";
            $response = file_get_contents($verify_url . "?secret={$recaptcha_secret}&response={$recaptcha_response}");
            $response_data = json_decode($response);
            $email = htmlspecialchars($_POST['email']);
            if (!$response_data->success){
                return $this->showError("Please verify that you're not a robot.", $_POST);
            }
            if ($this->userService->getByEmail($email) !== null ) {
                return $this->showError("Email already exists!", $_POST);
            }

            
            $raw_password = htmlspecialchars($_POST['password']);
            $salt = base64_encode(random_bytes(16));
            $password = password_hash($raw_password . $salt, PASSWORD_DEFAULT);
            $type_of_user = \App\Models\enums\UserType::Customer;
            $first_name = !empty($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : null;
            $last_name = !empty($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : null;
            $phone_number = !empty($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : null;
            $user = new \App\Models\User();
            $user->email = $email;
            $user->hashed_password = $password;
            $user->type_of_user = $type_of_user;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->phone_number = $phone_number;
            $user->salt= $salt;

            $this->userService->insert($user);

            
            $_SESSION['user'] = $user;
            $this->index();
        }
        
    }

    private function showError($message, $formData) {
        $formData = $_POST;
        require __DIR__ . '/../views/user/register.php';
        echo "<script>
            const errorMessageDiv = document.getElementById('error-message');
            errorMessageDiv.style.display = 'block';
            errorMessageDiv.textContent = \"$message\";
        </script>";
        
        exit;
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