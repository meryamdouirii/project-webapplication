<?php
namespace App\Controllers;
use App\Models\Enums\UserType;
use DateTimeZone;
use \DateTime;

class UserController
{

    private $userService;
    private $emailService;

    function __construct()
    {
        $this->userService = new \App\Services\UserService();
        $this->emailService = new \App\Services\EmailService();
    }
    public function index()
    {
        $users = $this->userService->getAll();
        require __DIR__ . '/../views/management/index.php';
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            require __DIR__ . '/../views/management/create-user.php';
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = htmlspecialchars($_POST['email']);
            if ($this->userService->getByEmail($email) !== null ) {
                return $this->showError("Email already in use!", $_POST, '/../views/management/create-user.php');
            }
            $rawPassword = htmlspecialchars($_POST['password']);
            $confirmPassword = htmlspecialchars($_POST['confirm_password']);
            
            if ($rawPassword != $confirmPassword) {
                return $this->showError("Passwords do not match.", $_POST, '/../views/management/create-user.php');
            }
            $salt = base64_encode(random_bytes(16));
            $password = password_hash($rawPassword . $salt, PASSWORD_DEFAULT);
            $userType = UserType::from($_POST['type_of_user']);
            $first_name = !empty($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : null;
            $last_name = !empty($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : null;
            $phone_number = !empty($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : null;

            $user = new \App\Models\User(
                0,
                $userType,
                $first_name,
                $last_name,
                $phone_number,
                $email,
                $password,
                $salt
            );
            if ($this->userService->insert($user)) {
                $_SESSION['success_message'] = "User created successfully.";
                header("Location: /manage-users");
                exit;
            } else {
                return $this->showError("Something went wrong while adding the user", $_POST, '/../views/management/create-user.php');
            }
        }
    }
    public function edit()
    {
        
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $id = $_GET['id'];
            $model = $this->userService->getById($id);
            
            require __DIR__ . '/../views/management/edit-user.php';
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $id = $_GET['id'];
            $firstUser = $this->userService->getById($id);

            $email = htmlspecialchars($_POST['email']);
            $secondUser = $this->userService->getByEmail($email);
            if ($secondUser !== null && $secondUser->id != $firstUser->id) {
                return $this->showError("Email already in use!", $_POST, '/../views/management/edit-user.php');
            }
            $salt = $firstUser->salt;
            $password = $firstUser->hashed_password;
            $userType = UserType::from($_POST['type_of_user']);
            $first_name = !empty($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : null;
            $last_name = !empty($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : null;
            $phone_number = !empty($_POST['phone_number']) ? htmlspecialchars($_POST['phone_number']) : null;

            $user = new \App\Models\User(
                $firstUser->id,
                $userType,
                $first_name,
                $last_name,
                $phone_number,
                $email,
                $password,
                $salt
            );
            
            if ($this->userService->update($user)) {
                $_SESSION['success_message'] = "User updated successfully.";
                header("Location: /manage-users");
                exit;
            } else {
                return $this->showError("Something went wrong while updating the user", $_POST, '/../views/management/edit-user.php');
            }
        }
        
    }
    public function delete()
    {
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            if (!isset($_GET['id']) || empty($_GET['id'])) {
                echo "No user ID provided.";
                exit;
            }
    
            $id = $_GET['id'];
            if (!isset($_SESSION['user']) || empty($_SESSION['user']['id'])) {
                
                $this->showDeleteError("Unauthorized access.");
            }
            if ($id == $_SESSION['user']['id']) {
               
                $this->showDeleteError("You cannot delete your own account.");
            
            }
            if ($this->userService->delete($id)){
                $_SESSION['success_message'] = "User deleted successfully.";
                header("Location: /manage-users");
                exit;
               
            } else {
                
                $this->showDeleteError("Something went wrong while deleting user");
            }
        }
    }
    private function showError($message, $formData, $view) {
        $formData = $_POST;
        $model = $formData;
        require __DIR__ . $view;
        echo "<script>
            const errorMessageDiv = document.getElementById('error-message');
            errorMessageDiv.style.display = 'block';
            errorMessageDiv.textContent = \"$message\";
        </script>";
        
        exit;
    }
    private function showDeleteError($message) {
        
        $_SESSION['error_message'] = $message;
        header("Location: /manage-users");
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

            $this->emailService->sendEmail($email, $subject, $body);
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
            $_SESSION['error'] = "New passwords do not match.";
            header("Location: /resetPasswordThroughMailLink?token=$token");
            exit;
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

    public function updatePersonalInformation()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $newEmail = htmlspecialchars($_POST['email']);
            $firstName = htmlspecialchars($_POST['first_name']);
            $lastName = htmlspecialchars($_POST['last_name']);
            $phoneNumber = htmlspecialchars($_POST['phone_number']);

            $existingUser = $this->userService->getByEmail($newEmail);
            if ($existingUser && $existingUser->id !== $userId) {
                $_SESSION['error'] = "This email is already in use.";
                header("Location: /manageAccount");
                exit;
            }

            $user = $this->userService->getById($userId);
            $user->email = $newEmail;
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->phone_number = $phoneNumber;

            $this->userService->updatePersonalInformation($user);

            // Update the session array with the new values
            $_SESSION['user']['email'] = $newEmail;
            $_SESSION['user']['first_name'] = $firstName;
            $_SESSION['user']['last_name'] = $lastName;
            $_SESSION['user']['phone_number'] = $phoneNumber;
            header("Location: /");
            exit;
        }
    }

    public function updatePasswordInManageAccount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $newPassword = htmlspecialchars($_POST['new_password']);
            $confirmNewPassword = htmlspecialchars($_POST['confirm_new_password']);
    
    
            if ($newPassword !== $confirmNewPassword) {
                $_SESSION['error'] = "New passwords do not match.";
                header("Location: /manageAccount");
                exit;
            }
    
            $newSalt = base64_encode(random_bytes(16));
            $newHashedPassword = password_hash($newPassword . $newSalt, PASSWORD_DEFAULT);
            $this->userService->updatePasswordInManageAccount($userId, $newHashedPassword, $newSalt);
            $_SESSION['success'] = "Password updated successfully!";
            header("Location: /");
            exit;
        }
    }





    
}