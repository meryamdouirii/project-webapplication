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
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.DefinitionImpl', null);
        $this->purifier = new HTMLPurifier($config);
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
            require("../views/management/events/manage-detailevents.php");
        }
        
    }
    public function editMainEvent(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
                $this->index();
                exit;
            }
            $event_id = $_GET['event_id']; 
            $picked_event = $this->eventService->getById($event_id);
            require("../views/management/events/edit-mainevent.php");
        }
    }
    public function addDetailEvent(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_GET['main_event_id']) || empty($_GET['main_event_id'])) {
                $this->index();
                exit;
            }
            $main_event_id = $_GET['main_event_id']; 
            $picked_event = $this->eventService->getById($main_event_id);
            require("../views/management/events/add-detailevent.php");
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
        
            if ($this->detailEventService->add($detailEvent)) {
                $_SESSION['success_message'] = "Detail event has been added successfully!";
            } else {
                $_SESSION['error_message'] = "Failed to add Detail event.";
            }
            $this->index();
        }

    }
    function editDetailEvent(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_GET['detailevent_id']) || empty($_GET['detailevent_id'])) {
                $this->index();
                exit;
            }
            $detailevent_id = $_GET['detailevent_id']; 
            $detail_event = $this->detailEventService->getById($detailevent_id);
            $existing_tags = $detail_event->getTags();
            require("../views/management/events/edit-detailevent.php");
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['detail_event_id']); 
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
        
            if ($this->detailEventService->update($detailEvent)) {
                $_SESSION['success_message'] = "Detail event has been updated successfully!";
            } else {
                $_SESSION['error_message'] = "Failed to update Detail event.";
            }
            $this->index();
        }

    }
    function deleteDetailEvent(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_GET['detailevent_id']) || empty($_GET['detailevent_id'])) {
                $this->index();
                exit;
            }
            $detailevent_id = $_GET['detailevent_id']; 
            if ($this->detailEventService->delete($detailevent_id)) {
                $_SESSION['success_message'] = "Detail event has been deleted successfully!";
            } else {
                $_SESSION['error_message'] = "You cannot delete this event.";
            }
            
        }
        $this->index();
        
            
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