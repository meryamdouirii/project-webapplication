<?php 

namespace App\controllers;


class HomeController 
{
    public function index() {
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