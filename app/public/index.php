<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


$url = parse_url($_SERVER['REQUEST_URI'])['path'];
use \App\Controllers\HomeController;

require_once("../vendor/autoload.php");

$homeController = new HomeController();


session_start();

switch ($url) {
    case "/";
        $homeController->index();
        break;
    case "/music-icon":
        $homeController->musicIcon();
        break;
    case "/location-icon":
        $homeController->locationIcon();
        break;
    case "/calendar-icon":
        $homeController->calendarIcon();
        break;
    default:
        http_response_code(404);
}
