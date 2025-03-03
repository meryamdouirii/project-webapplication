<?php 

namespace App\controllers;

class EventController 
{
    private $detailEventService;
    
    function __construct()
    {
        $this->detailEventService = new \App\Services\DetailEventService();
    }

    public function danceMain(){
        $detailEvents = $this->detailEventService->getByMainEvent(1);
        require("../views/event/dance/dance-main.php");
    }
    public function yummyMain(){
        $detailEvents = $this->detailEventService->getByMainEvent(2);
        require("../views/event/yummy!/yummy-main.php");
    }
    public function yummyDetail() {

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: /event/yummy-main");
            exit;
        }
    
        $eventId = intval($_GET['id']);
    
        $detailEvent = $this->detailEventService->getById($eventId);
    
        if (!$detailEvent) {
            header("Location: /event/yummy-main");
            exit;
        }
        require("../views/event/yummy!/yummy-detail.php");
    }
    
}