<?php

namespace App\controllers;

class CartController
{

    private $sessionService;
    private $orderService;
    private $paymentService;
    private $ticketService;
    function __construct()
    {
        $this->sessionService = new \App\Services\SessionService();
        $this->orderService = new \App\Services\OrderService();
        $this->paymentService = new \App\Services\Paymentservice();
        $this->ticketService = new \App\Services\TicketService();
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

            if ($_POST["event_id"] == 1) {
                header("Location: /dance/tickets");
            } else if ($_POST["event_id"] == 2) {
                header("Location: /yummy/tickets");
            }
            
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

    
    // public function placeOrderInDatabase($tickets){
    //     $this->orderService->placeOrder($tickets);    
    // }

    // public function makePayment(){
    //     if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    //         $tickets = $_SESSION['cart'];
    //         // Geef de tickets mee als parameter naar de payment service
    //         $this->paymentService->makePayment($tickets, $orderId, $totalAmount);
    //     } else {
    //         echo "Cart is empty.";
    //     }
    // }

    public function confirmOrder() {
        // Indien gebruiker niet is ingelogd, naar login pagina
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['type_of_user'])) {
            require("../views/user/login.php");
            return;
        }
        
        // Indien de cart leeg is, toon een bevestigingspagina (of een foutmelding)
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            require("../views/customer/confirm_order.php");
            return;
        }
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $tickets = $_SESSION['cart'];

            if ($_SESSION['user']['type_of_user'] === 'customer') {
                // Plaats de order in de database en verkrijg het order-ID

                foreach ($tickets as $ticket) {
                   if ($this->sessionService->getById($ticket['session_id'])->getTicketLimit() <= $this->ticketService->countTicketsBySessionId($ticket['session_id'])) {
                        $_SESSION['error_message'] = "For the session " . $ticket['event_name']." at " . $ticket['event_time']." there are no tickets available anymore. Remove the ticket from your cart to continue.";
                        header("Location: /cart");
                        exit;
                    }
                }
                $orderId = $this->orderService->placeOrder($tickets);
                
                // Bereken totaalbedrag in centen (aantal * prijs in centen)
                $totalAmount = 0;
                foreach ($tickets as $ticket) {
                    $totalAmount += intval($ticket['quantity']) * intval(floatval($ticket['event_price']) * 100);
                }
                
                

                // Maak de pending betaling aan en redirect naar Stripe
                $this->paymentService->makePayment($tickets, $orderId, $totalAmount);
                
                // Maak de winkelwagen leeg (om dubbele orders te voorkomen)
                unset($_SESSION["cart"]);
            }
        } else {
            // Als het geen POST-request is, tonen we de confirm order pagina (met de "Pay with iDEAL" knop)
            require("../views/customer/confirm_order.php");
        }
    }
    
    
}

