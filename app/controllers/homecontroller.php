<?php 

namespace App\controllers;
use App\Repositories\EventRepository;
use App\Repositories\HomepageRepository;


class HomeController 
{
    public function index() {
        $eventRepository = new EventRepository();
        $events = $eventRepository->getAll();
        $homepageRepository = new HomepageRepository();
        $homepage = $homepageRepository->getById(1);
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
            if ($user != null && password_verify($password, $user->hashed_password)) {
                $_SESSION['user'] = $user;
                $this->about();
            } else {
                require __DIR__ . '/../views/home/login.php';
                ?>
                <?php
            }
        }

        
    }

    public function register(){
        require("../views/user/register.php");
    }

    public function logout(){
        require("../views/user/logout.php");
    }

}


?>