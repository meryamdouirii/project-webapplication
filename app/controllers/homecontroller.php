<?php 

namespace App\controllers;

// include __DIR__ . '/../vendor/autoload.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

use \DateTime;
use \DateTimeZone;


class HomeController 
{
    private $userService;
    private $homepageService;
    private $eventService;
    private $emailService;

    function __construct(){
        $this->userService = new \App\Services\UserService();
        $this->homepageService = new \App\Services\HomepageService();
        $this->eventService = new \App\Services\EventService();
        $this->emailService = new \App\Services\EmailService();
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
            if ($raw_password != htmlspecialchars($_POST['confirm_password'])) {
                return $this->showError("Passwords do not match.", $_POST);
            }

            
           
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

            $user = $this->userService->getByEmail($email);
            
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

    public function sentPasswordResetEmail(){
        
        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
            $token = bin2hex(random_bytes(64));
            $reset_token_hash = hash("sha256", $token);

            $timezone = new DateTimeZone("Europe/Amsterdam"); 
            $expiry = (new DateTime("now", $timezone))
            ->modify("+30 minutes")
                ->format("Y-m-d H:i:s");

            $this->userService->setToken($reset_token_hash, $expiry, $email);

            $subject = "Password Reset";
            $body = "Click <a href='localhost/resetPasswordThroughMailLink?token=$token'>here</a> to reset your password.";

            $this->emailService->sendEmail($email, $token, $subject, $body);
        }
        require("../views/user/passwordResetEmailSent.php");
    }

    public function resetPasswordThroughMailLink(){
        if (!isset($_GET['token'])) {
            die("Link not valid: Missing token.");
        }

        // Get token from URL
        $token = $_GET['token'];
        $token_hash = hash('sha256', $token);

        $user = $this->userService->getByResetTokenHash($token_hash);


        // Check if user exists and token is valid
        if (!is_object($user))  {
            die("Link not valid: Invalid or expired tokennn.");
        }

        //Token is valid, load the reset password page
        require("../views/user/resetPasswordThroughMailLink.php");
        
    }

    public function updatePassword() {
        //Debug: Print the POST data
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // exit(); 

        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            die("Invalid request method.");
        }
        if (empty($_POST['token']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
            die("Missing required fields.");
        }
        
    
        $token = $_POST['token'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
    
        if ($password !== $confirm_password) {
            die("Passwords do not match.");
        }
    
        $token_hash = hash('sha256', $token);
        $user = $this->userService->getByResetTokenHash($token_hash);
    
        if (!is_object($user)) {
            die("Invalid or expired token.");
        }

        $new_salt = base64_encode(random_bytes(16));
        $hashed_password = password_hash($password . $new_salt, PASSWORD_DEFAULT);
        $this->userService->updateUserPassword($user->email, $hashed_password, $new_salt);
    
        // Redirect naar login pagina of bevestigingspagina
        header("Location: /passwordResetSuccess");
        exit();        
    }

    public function passwordResetSuccess(){
        require("../views/user/passwordResetSuccess.php");
    }
    

}


?>