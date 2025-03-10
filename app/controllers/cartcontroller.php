<?php

namespace App\controllers;

class CartController
{

    private $sessionService;
    function __construct()
    {
        $this->sessionService = new \App\Services\SessionService();
    }

    public function viewCart()
    {
        require("../views/customer/cart.php");
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

    public function updateCart()
    {       
        header('Content-Type: application/json');
        // Read the JSON request
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo json_encode(['success' => false]);
            exit;
        } 
        if (isset($data['remove']) && $data['remove']) {
            // Remove item from cart
            unset($_SESSION['cart'][$data['index']]);
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
        } else {
            // Update quantity
            $index = $data['index'];
            $quantity = max(1, $data['quantity']); // Ensure quantity is at least 1
            $_SESSION['cart'][$index]['quantity'] = $quantity;
        }
        
        // Recalculate total price
        $totalPrice = 0;
        foreach ($_SESSION['cart'] as $item) {
            $totalPrice += $item['event_price'] * $item['quantity'];
        }
        
        $response = [
            'success' => true,
            'totalPrice' => number_format($totalPrice, 2, ',', '.'),
            'totalWithTax' => number_format($totalPrice * 1.1, 2, ',', '.')
        ];
        
        echo json_encode($response);
    }



}
