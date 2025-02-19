<?php
namespace App\Controllers;
use App\Models\Enums\UserType;

class UserController
{

    private $userService;

    function __construct()
    {
        $this->userService = new \App\Services\UserService();
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

            $user = new \App\Models\User();
            $user->email = $email;
            $user->hashed_password = $password;
            $user->type_of_user = $userType;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->phone_number = $phone_number;
            $user->salt = $salt;
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

            $user = new \App\Models\User();
            $user->email = $email;
            $user->hashed_password = $password;
            $user->type_of_user = $userType;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->phone_number = $phone_number;
            $user->salt = $salt;
            $user->id = $firstUser->id;
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
            if (!isset($_SESSION['user']) || empty($_SESSION['user']->id)) {
                
                $this->showDeleteError("Unauthorized access.");
            }
            if ($id == $_SESSION['user']->id) {
               
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
}