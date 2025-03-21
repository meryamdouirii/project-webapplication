<?php 

namespace App\controllers;

use HTMLPurifier;
use HTMLPurifier_Config;

class ManageEventsController 
{
    private $uploadService;
    private $detailEventService;
    private $eventService;
    private $purifier;
    function __construct()
    {
        $this->purifier = new HTMLPurifier(HTMLPurifier_Config::createDefault());
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id=null;
            $event_id = intval($_POST['main_event_id']); 
            $banner_description = $this->purifier->purify($_POST['banner_description']) ?? null;
            $banner_image = $this->extractImagePath($_POST['banner_image']) ?? null;
            $name = $_POST['name'];
            $description = $this->purifier->purify($_POST['description']) ?? null;
            $image_description_1 = $this->extractImagePath($_POST['image_description_1']) ?? null;
            $image_description_2 = $this->extractImagePath($_POST['image_description_2']) ?? null;
            $card_image = $this->extractImagePath($_POST['card_image']) ?? null;
            $card_description = $this->purifier->purify($_POST['card_description']) ?? null;
            $amount_of_stars = isset($_POST['amount_of_stars']) ? intval($_POST['amount_of_stars']) : 0;
            $tags = json_decode($_POST['tags'], true) ?? null;
            $sessions = []; 
            $songs = []; 
        
            // Now create the object using the constructor
            $detailEvent = new \App\Models\DetailEvent( 
                $id,
                $event_id, 
                $banner_description, 
                $banner_image, 
                $name, 
                $description, 
                $image_description_1, 
                $image_description_2, 
                $card_image, 
                $card_description, 
                $amount_of_stars, 
                $tags, 
                $sessions, 
                $songs
            );
        
            // Proceed with calling your service method
            $this->detailEventService->add($detailEvent);
        }
        require("../views/management/events/add-detailevent.php");
    }
    function extractImagePath($html) {
        // Regular expression to match the src URL
        preg_match('/src="(http:\/\/localhost[\/\w\.-]+)/', $html, $matches);
    
        // Check if the URL was found and return the path after "localhost"
        if (isset($matches[1])) {
            return str_replace("http://localhost", "", $matches[1]);
        }
        return null; // Return null if the src is not found
    }
    public function uploadImage()
    {
        $this->uploadService->uploadImage();

    }
    
}