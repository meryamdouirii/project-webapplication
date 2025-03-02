<?php 

namespace App\controllers;



class EventController 
{

    private $detailEventService;

    function __construct(){
        $this->detailEventService = new \App\Services\DetailEventService();
    }

    public function yummyMain(){
        $detailEvents = $this->detailEventService->getByMainEvent(2);
        require("../views/event/yummy!/yummy-main.php");
    }
}