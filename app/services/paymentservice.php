<?php 
namespace App\Services;
require '../vendor/autoload.php';

class Paymentservice {
    public function makePayment($tickets, $orderId, $totalAmount) {
        if (!class_exists('\Stripe\Stripe')) {
            die('Error: Stripe SDK is not loaded.');
        }
        $stripe_secret_key = "sk_test_51R1YKaEDbl26ZBTZCDHxFdd1VG754ZtWAbKpIG1rukbX2qKwnGcxVPCWBqCHlluRB7o42ZrSHlVBqeMZpD04KB8000nnyLDeZk";
        \Stripe\Stripe::setApiKey($stripe_secret_key);
        
        // Bouw de line items op basis van de tickets
        $lineItems = [];
        foreach ($tickets as $ticket) {
            $lineItems[] = [
                "quantity" => intval($ticket['quantity']),
                "price_data" => [
                    "currency" => "eur",
                    // Stripe verwacht het bedrag in centen
                    "unit_amount" => intval(floatval($ticket['event_price']) * 100),
                    "product_data" => [
                        "name" => $ticket['event_name']
                    ]
                ]
            ];
        }
        
        try {
            // Maak de succes-URL: we voegen zowel de checkout session id (via placeholder) als het order id toe
            $success_url = "http://localhost/succesTest?session_id={CHECKOUT_SESSION_ID}&order_id=" . $orderId;
            $cancel_url = "http://localhost/cart";
        
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => $success_url,
                "cancel_url" => $cancel_url, 
                "payment_method_types" => ["card", "ideal"],
                "line_items" => $lineItems
            ]);
            
            // Sla het pending betalingsrecord op in de database
            $paymentRepository = new \App\Repositories\PaymentRepository();
            $paymentRepository->storePayment($orderId, $checkout_session->id, $totalAmount);
        
            http_response_code(303);
            header("Location: " . $checkout_session->url);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
