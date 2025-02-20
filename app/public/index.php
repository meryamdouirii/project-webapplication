<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


$url = parse_url($_SERVER['REQUEST_URI'])['path'];

use \App\Controllers\HomeController;
use \App\Controllers\UserController;

require_once("../vendor/autoload.php");

$homeController = new HomeController();
$userController = new UserController();


session_start();

switch ($url) {
    case "/";
        $homeController->index();
        break;
    case "/login";
        $homeController->login();
        break;
    case "/register";
        $homeController->register();
        break;
    case "/logout";
        $homeController->logout();
        break;
    case "/resetPassword";
        $homeController->resetPassword();
        break;
    case "/sentPasswordResetEmail";
        $homeController->sentPasswordResetEmail();
        break;
    case "/resetPasswordThroughMailLink";
        $homeController->resetPasswordThroughMailLink();
        break;
    case "/updatePassword";
        $homeController->updatePassword();
        break;
    case "/passwordResetSuccess";
        $homeController->passwordResetSuccess();
        break;
    case "/manage-users";
        $userController->index();
        break;
    case "/manage-users/add";
        $userController->add();
        break;
    case "/manage-users/edit";
        $userController->edit();
        break;
    case "/manage-users/delete";
        $userController->delete();
        break;
    default:
        http_response_code(404);
}
