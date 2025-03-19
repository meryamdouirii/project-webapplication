<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

use \App\Controllers\HomeController;
use \App\Controllers\UserController;
use \App\Controllers\CustomerController;
use \App\Controllers\EventController;
use \App\Controllers\ManageEventsController;
use \App\Controllers\CartController;

require_once("../vendor/autoload.php");

$homeController = new HomeController();
$userController = new UserController();
$customerController = new CustomerController();
$eventController = new EventController();
$manageEventsController = new ManageEventsController();
$cartController = new CartController();


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
        $userController->resetPassword();
        break;
    case "/sentPasswordResetEmail";
        $userController->sentPasswordResetEmail();
        break;
    case "/resetPasswordThroughMailLink";
        $userController->resetPasswordThroughMailLink();
        break;
    case "/updatePassword";
        $userController->updatePassword();
        break;
    case "/passwordResetSuccess";
        $userController->passwordResetSuccess();
        break;
    case "/manage-events";
    $manageEventsController->index();
    break;
    case "/manage-events/event";
    $manageEventsController->manageEvent();
        break;
    case "/manage-events/manage-detailevents";
    $manageEventsController->manageDetailEvent();
        break;
    case "/manage-events/add-detailevent";
    $manageEventsController->addDetailEvent();
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
    case "/manageDetailEvent/uploadImage";
    $manageEventsController->uploadImage();
        break;
    case "/manageAccount";
        $customerController->manageAccount();
        break;
    case "/updateAccount";
        $userController->updatePersonalInformation();
        break;
    case "/changePassword";
        $userController->updatePasswordInManageAccount();
        break;
    case "/Dance";
        $eventController->danceMain();
        break;
    case "/Dance/detail";
        $eventController->danceDetail();
        break;
    case "/Yummy!";
        $eventController->yummyMain();
        break;
    case "/Yummy!/detail";
        $eventController->yummyDetail();
        break;
    case "/dance/tickets";
        $eventController->danceTickets();
        break;
    case "/yummy/tickets";
        $eventController->yummyTickets();
        break;
    case "/addToCart";
        $cartController->addToCart();
        break;
    case "/cart";
        $cartController->viewCart();
        break;
    case "/update_cart";
        $cartController->updateCart();
    case "/confirm_order";
        $cartController->confirmOrder();
        break;
    case "/personal_program";
        $customerController->personalProgram();
        break;
    default:
        http_response_code(404);
}
