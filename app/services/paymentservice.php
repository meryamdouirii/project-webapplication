<?php 
namespace App\Services;
require '../vendor/autoload.php';

class Paymentservice {
    public function makePayment($tickets) {
        if (!class_exists('\Stripe\Stripe')) {
            die('Error: Stripe SDK is not loaded.');
        }
        $stripe_secret_key = "sk_test_51R1YKaEDbl26ZBTZCDHxFdd1VG754ZtWAbKpIG1rukbX2qKwnGcxVPCWBqCHlluRB7o42ZrSHlVBqeMZpD04KB8000nnyLDeZk";
        \Stripe\Stripe::setApiKey($stripe_secret_key);
        

        $lineItems = [];
        foreach ($tickets as $ticket) {
            $lineItems[] = [
                "quantity" => intval($ticket['quantity']),
                "price_data" => [
                    "currency" => "eur",
                    "unit_amount" => intval(floatval($ticket['event_price']) * 100),
                    "product_data" => [
                        "name" => $ticket['event_name']
                    ]
                ]
            ];
        }
        
        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => "http://localhost/succesTest",
                "cancel_url" => "http://localhost/cart", 
                "payment_method_types" => ["card", "ideal"],
                "line_items" => $lineItems
            ]);
        
            http_response_code(303);
            header("Location: " . $checkout_session->url);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
