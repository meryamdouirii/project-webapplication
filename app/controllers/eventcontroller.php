<?php 

namespace App\controllers;



class EventController 
{
    public function danceEvent(){
        require("../views/event/dance/dance-main.php");
    }
    public function yummyMain(){

        require("../views/event/yummy!/yummy-main.php");
    }
}