<?php

namespace App\controllers;



class OrderController
{
    private $orderService;

    function __construct()
    {

        $this->orderService = new \App\Services\OrderService();
    }

    public function index()
    {   
        $orders = $this->orderService->getAll();
        require("../views/management/orders/index.php");
    }


}


?>