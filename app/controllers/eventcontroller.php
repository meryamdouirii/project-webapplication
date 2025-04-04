<?php 

namespace App\controllers;

class EventController 
{
    private $detailEventService;
    private $EventService;
    private $ticketService;
    private $sessionService;
    function __construct()
    {
        $this->detailEventService = new \App\Services\DetailEventService();
        $this->EventService = new \App\Services\EventService();
        $this->sessionService = new \App\Services\SessionService();
        $this->ticketService = new \App\Services\TicketService();
    }
    public function danceMain(){
        $detailEvents = $this->detailEventService->getByMainEvent(1);
        $eventDance = $this->EventService->getById(1);
        $sessionsByDate = $this->sessionService->getSessionsGroupedByDateAndEventId(1);
        require("../views/event/dance/dance-main.php");
    }
    public function danceDetail(){
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: /event/dance-main");
            exit;
        }

        $detailEvent = intval($_GET['id']);
        $detailEvent = $this->detailEventService->getById($detailEvent);
        
        if (!$detailEvent) {
            header("Location: /event/dance-main");
            exit;
        }
        require("../views/event/dance/dance-detail.php");
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

            $detailYummyEvent = $this->detailEventService->getById($eventId);
            $yummySessions = $this->sessionService->getSessionsByDetailEventId($eventId);
        
            if (!$detailYummyEvent) {
                header("Location: /event/yummy-main");
                exit;
            }
            require("../views/event/yummy!/yummy-detail.php");
    }
    public function danceTickets(){
        
        $sessionsByDate = $this->sessionService->getSessionsGroupedByDateAndEventId(1);
    
        
        require("../views/customer/tickets.php");
    }
    public function yummyTickets(){
        $soldTickets = $this->ticketService->getAll();
        
        $sessionsByDate = $this->sessionService->getSessionsGroupedByDateAndEventId(2);


        
        require("../views/customer/tickets.php");
    }
  
    
}