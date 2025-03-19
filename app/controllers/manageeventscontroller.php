<?php 

namespace App\controllers;

class ManageEventsController 
{
    private $uploadService;
    private $detailEventService;
    private $eventService;
    function __construct()
    {
        $this->uploadService = new \App\Services\UploadService();
        $this->eventService = new \App\Services\EventService();
        $this->detailEventService = new \App\Services\DetailEventService();
    }
    public function index(){
        require("../views/management/events/index.php");
    }
    public function manageEvent(){
        if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
            $this->index();
            exit;
        }
            $event_id = $_GET['event_id']; 
            $picked_event = $this->eventService->getById($event_id);
            
            require("../views/management/events/manage-event.php");
        
    }
    public function manageDetailEvent(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content']; 
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
                $this->index();
                exit;
            }
            $event_id = $_GET['event_id']; 
            $picked_event = $this->eventService->getById($event_id);
            $detailEvents = $this->detailEventService->getByMainEvent($event_id);
        }
        require("../views/management/events/manage-detailevents.php");
    }
    public function addDetailEvent(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_GET['main_event_id']) || empty($_GET['main_event_id'])) {
                $this->index();
                exit;
            }
            $main_event_id = $_GET['main_event_id']; 
            $picked_event = $this->eventService->getById($main_event_id);
        }
        require("../views/management/events/add-detailevent.php");
    }
    public function uploadImage()
    {
        $this->uploadService->uploadImage();

    }
    
}