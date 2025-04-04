<?php

namespace App\controllers;


use \DateTime;
use \DateTimeZone;


class CustomerController
{
    private $userService;
    private $orderService;

    function __construct()
    {
        $this->userService = new \App\Services\UserService();
        $this->orderService = new \App\Services\OrderService();
    }

    public function manageAccount()
    {
        $user = $this->userService->getById($_SESSION['user']['id']);
        require("../views/customer/manageAccount.php");
    }

    public function personalProgram()
    {

        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $orders = $this->orderService->getUserOrders($userId);
        require("../views/customer/personal_program.php");
    }



}


?>