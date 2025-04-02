<?php 

namespace App\controllers;

use HTMLPurifier;
use HTMLPurifier_Config;
use App\Models\Session;
class ManageEventsController 
{
    private $uploadService;
    private $detailEventService;
    private $eventService;
    private $purifier;
    private $sessionService;
    function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.DefinitionImpl', null);
        $this->purifier = new HTMLPurifier($config);
        $this->uploadService = new \App\Services\UploadService();
        $this->eventService = new \App\Services\EventService();
        $this->detailEventService = new \App\Services\DetailEventService();
        $this->sessionService = new \App\Services\SessionService();
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){  
            $id = intval($_POST['event_id']); 
            $name = $_POST['name'];
            $banner_description = $this->purifier->purify($_POST['banner_description']) ?? null;
            $description = $this->purifier->purify($_POST['description_homepage']) ?? null;
            $image = $this->extractImagePath($_POST['banner_image']) ?? null;

            $mainEvent = new \App\Models\Event();
            $mainEvent->id = $id;
            $mainEvent->name = $name;
            $mainEvent->banner_description = $banner_description;
            $mainEvent->description_homepage = $description;
            $mainEvent->picture_homepage = $image;

            if ($this->eventService->update($mainEvent)) {
                $_SESSION['success_message'] = "Main event has been updated successfully!";
            } else {
                $_SESSION['error_message'] = "Failed to update Main event.";
            }
            $this->index();
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
                $_SESSION['success_message'] = "Detail event has been addedsuccessfully!";
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
    function manageSessions(){
        $detailevent_id = $_GET['detailevent_id'] ?? null;
        if ($detailevent_id) {
            $detail_event = $this->detailEventService->getById($detailevent_id);
            $sessions = $this->sessionService->getSessionsByDetailEventId($detailevent_id);
        } else {
            $_SESSION['error_message'] = "No detail event ID provided.";
            $this->index();
            exit;
        }
        require("../views/management/events/manage-sessions.php");
    }

    function editSession(){
        $session_id = $_GET['session_id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            if ($session_id) {
                $session = $this->sessionService->getById($session_id);
                require("../views/management/events/edit-session.php");
            } else {
                $_SESSION['error_message'] = "No session ID provided.";
                $this->index();
                exit;
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){

            $session_id = isset($_POST['session_id']) ? (int) $_POST['session_id'] : null;
            $detailevent_id = isset($_POST['detailevent_id']) ? (int) $_POST['detailevent_id'] : null;
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '';
            $description = isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8') : null;
            $location = isset($_POST['location']) ? htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8') : null;
            $price = isset($_POST['price']) ? (float) $_POST['price'] : 0.0;
            $ticket_limit = isset($_POST['ticket_limit']) ? (int) $_POST['ticket_limit'] : 0;
            $date_start = isset($_POST['date_start']) ? $_POST['date_start'] : '';
            $time_start = isset($_POST['time_start']) ? $_POST['time_start'] : '';
            $duration_minutes = isset($_POST['duration_minutes']) ? (int) $_POST['duration_minutes'] : 0;
    
            $datetime_start = $date_start . ' ' . $time_start;

            $session = new Session(
                $session_id, 
                $detailevent_id,
                $name,
                null,
                $description,
                $location,
                $ticket_limit,
                $duration_minutes,
                $price,
                $datetime_start,
                0
            );
            try {
                $this->sessionService->update($session);
                $_SESSION['success_message'] = "Session has been updated!";
                $this->index();
            } catch (\Exception $e) {
                $_SESSION['error_message'] = "Something went wrong while adding the session.";
                $this->index();
            }
        }
        
    }
    function addSession(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $detailevent_id = $_GET['detailevent_id'] ?? null;
            if ($detailevent_id) {
                require("../views/management/events/add-session.php");
            } else {
                $_SESSION['error_message'] = "No detail event ID provided.";
                $this->index();
                exit;
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input
            $detailevent_id = isset($_POST['detailevent_id']) ? (int) $_POST['detailevent_id'] : null;
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '';
            $description = isset($_POST['description']) ? htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8') : null;
            $location = isset($_POST['location']) ? htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8') : null;
            $price = isset($_POST['price']) ? (float) $_POST['price'] : 0.0;
            $ticket_limit = isset($_POST['ticket_limit']) ? (int) $_POST['ticket_limit'] : 0;
            $date_start = isset($_POST['date_start']) ? $_POST['date_start'] : '';
            $time_start = isset($_POST['time_start']) ? $_POST['time_start'] : '';
            $duration_minutes = isset($_POST['duration_minutes']) ? (int) $_POST['duration_minutes'] : 0;
    
            // Format datetime
            $datetime_start = $date_start . ' ' . $time_start;
    

            $session = new Session(
                0, 
                $detailevent_id,
                $name,
                null,
                $description,
                $location,
                $ticket_limit,
                $duration_minutes,
                $price,
                $datetime_start,
                0
            );
            try {
                $this->sessionService->insert($session);
                $_SESSION['success_message'] = "Session has been added!";
                $this->index();
            } catch (\Exception $e) {
                $_SESSION['error_message'] = "Something went wrong while adding the session.";
                $this->index();
            }
            
        }

    }
    function deleteSession(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            if(!isset($_GET['session_id']) || empty($_GET['session_id'])){
                $this->index();
                exit;
            }
            $session_id = $_GET['session_id'];
            try {
                $this->sessionService->delete($session_id);
                $_SESSION['success_message'] = "Session has been deleted successfully!";
                $this->index();
            } catch (\Exception $e) {
                $_SESSION['error_message'] = "You cannot delete this session, because there are already sold tickets.";
                $this->index();
            }
            
        }
    }
    function deleteDetailEvent(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!isset($_GET['detailevent_id']) || empty($_GET['detailevent_id'])) {
                $this->index();
                exit;
            }
            $detailevent_id = $_GET['detailevent_id']; 
            try {
                $this->detailEventService->delete($detailevent_id);
                $_SESSION['success_message'] = "Detail event has been deleted successfully!";
                $this->index();
            } catch (\Exception $e) {
                $_SESSION['error_message'] = "You cannot delete this event, because there are still sessions linked to it.";
                $this->index();
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