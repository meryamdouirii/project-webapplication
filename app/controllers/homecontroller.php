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
    }

    public function register(){
        require("../views/user/register.php");
    }

    public function logout(){
        require("../views/user/logout.php");
    }

}


?>