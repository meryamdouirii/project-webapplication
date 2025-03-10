<?php

namespace App\controllers;

class CartController
{

    private $sessionService;
    function __construct()
    {
        $this->sessionService = new \App\Services\SessionService();
    }

    public function addToCart()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $ticket = [
                "session_id" => $_POST["session_id"],
                "event_name" => $_POST["event_name"],
                "event_location" => $_POST["event_location"],
                "event_time" => $_POST["event_time"],
                "event_duration" => $_POST["event_duration"],
                "event_price" => $_POST["event_price"],
                "quantity" => $_POST["quantity"]
            ];

            if (!isset($_SESSION["cart"])) {
                $_SESSION["cart"] = [];
            }

            // Kijken of session al in cart zit zodat je de aantal kan updaten zodat er geen dubbele ticket items zijn
            $found = false;
            foreach ($_SESSION["cart"] as &$cartItem) {
                if ($cartItem["session_id"] == $ticket["session_id"]) {
                    $cartItem["quantity"] += $ticket["quantity"];
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION["cart"][] = $ticket;
            }

            //add a pop up message to show that the ticket has been added to the cart
            header("Location: /dance/tickets");
            exit();
        }
    }



}
