<?php 

namespace App\controllers;

// include __DIR__ . '/../vendor/autoload.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

use \DateTime;
use \DateTimeZone;


class CustomerController 
{
    private $userService;

    function __construct(){
        $this->userService = new \App\Services\UserService();
    }

    public function manageAccount() {
        $user = $this->userService->getById($_SESSION['user']['id']);
        require("../views/customer/manageAccount.php");
    }

    
}


?>