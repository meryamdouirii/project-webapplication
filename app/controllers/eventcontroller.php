<?php 

namespace App\controllers;

class EventController 
{

    private $eventService;
    private $detailEventCardTagService;
    private $detailEventService;
    private $sessionService;
    function __construct()
    {
        $this->eventService = new \App\Services\EventService();
        $this->detailEventCardTagService = new \App\Services\DetailEventCardTagService();
        $this->detailEventService = new \App\Services\DetailEventService();
        $this->sessionService = new \App\Services\SessionService();
    }

    public function danceMain(){
        $event = $this->eventService->getById(1); // get the event with id 1 which is the dance event
        $tags = $this->detailEventCardTagService->getTagsByDetailEventId($event->id);
        $detailEvents = $this->detailEventService->getById($event->id);
        $session = $this->sessionService->getByEventId($event->id);
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