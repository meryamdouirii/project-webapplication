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
    
        // Read and decode JSON request
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
    
        // Ensure JSON is valid
        if ($data === null) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON received']);
            exit;
        }
    
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo json_encode(['success' => false, 'message' => 'Cart is empty']);
            exit;
        } 
    
        if (isset($data['remove']) && $data['remove']) {
            // Remove item from cart 
            if (isset($_SESSION['cart'][$data['index']])) {
                unset($_SESSION['cart'][$data['index']]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid item index']);
                exit;
            }
        } else {
            // Ensure index and quantity are set
            if (!isset($data['index']) || !isset($data['quantity'])) {
                echo json_encode(['success' => false, 'message' => 'Missing index or quantity']);
                exit;
            }
    
            $index = intval($data['index']);
            $quantity = max(1, intval($data['quantity'])); // Ensure quantity is at least 1
    
            if (!isset($_SESSION['cart'][$index])) {
                echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
                exit;
            }
    
            $_SESSION['cart'][$index]['quantity'] = $quantity;
        }
    
        // Recalculate total price
        $totalPrice = 0;
        foreach ($_SESSION['cart'] as $item) {
            $totalPrice += floatval($item['event_price']) * intval($item['quantity']);
        }
    
        // Ensure only valid JSON is returned
        echo json_encode([
            'success' => true,
            'totalPrice' => number_format($totalPrice, 2, ',', '.'),
            'items' => $_SESSION['cart']
        ]);
        
        exit;
    }
    

    public function choosePaymentMethod()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['type_of_user'])) {
            //als er geen user is of geen type of user dus bv een visitor dan login pagina weergeven
            require("../views/user/login.php");
            return;
        }

        if ($_SESSION['user']['type_of_user'] === 'customer') {
            require("../views/customer/choose_payment_method.php");
        } else {
            echo "You are not supposed to be here";
        }
    }
    



}
