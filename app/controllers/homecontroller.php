<?php 

namespace App\controllers;


class HomeController 
{
    public function index() {
        require("../views/index.php");
    }
    public function login(){
        require("../views/login.php");
    }

}


?>