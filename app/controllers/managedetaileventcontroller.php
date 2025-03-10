<?php 

namespace App\controllers;

class ManageDetailEventController 
{
    private $uploadService;
    private $detailEventService;
    function __construct()
    {
        $this->uploadService = new \App\Services\UploadService();
        $this->detailEventService = new \App\Services\DetailEventService();
    }

    public function manageDetailEvent(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content']; 
        }
        require("../views/management/manage-detailevent.php");
    }
    public function uploadImage()
    {
        $this->uploadService->uploadImage();

    }
    
}