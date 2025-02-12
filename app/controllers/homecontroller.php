<?php 

namespace App\controllers;


class HomeController 
{
    public function index() {
        require("../views/index.php");
    }
    public function musicIcon() {
        require("../src/images-logos/music-icon.png");
    }
    public function locationIcon() {
        require("../src/images-logos/location-icon.png");
    }
    public function calendarIcon() {
        require("../src/images-logos/calendar-icon.png");
    }
    

}


?>