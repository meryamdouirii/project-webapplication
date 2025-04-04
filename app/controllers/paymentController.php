<?php
namespace App\Controllers;
use App\Repositories\PaymentRepository;

class PaymentController
{

    private $emailService;
    private $invoiceService;

    function __construct()
    {
        $this->emailService = new \App\Services\EmailService();
        $this->invoiceService = new \App\Services\InvoiceService();
    }

    public function success()
    {
        if (!isset($_GET['session_id']) || !isset($_GET['order_id'])) {
            echo "Invalid request.";
            return;
        }
        $session_id = $_GET['session_id'];
        $order_id = $_GET['order_id'];

        // Stel de Stripe API key in
        \Stripe\Stripe::setApiKey("sk_test_51R1YKaEDbl26ZBTZCDHxFdd1VG754ZtWAbKpIG1rukbX2qKwnGcxVPCWBqCHlluRB7o42ZrSHlVBqeMZpD04KB8000nnyLDeZk");

        try {
            // Haal de checkout sessie op
            $session = \Stripe\Checkout\Session::retrieve($session_id);
            if ($session->payment_status === "paid") {
                // Update het betalingsrecord in de database naar "paid"
                $paymentRepository = new \App\Repositories\PaymentRepository();
                $paymentRepository->updatePaymentStatus($session_id, "paid");
                // Toon een successpagina
                require("../views/customer/confirm_order.php");

                //een e-mail sturen naar de klant met de invoice van de tickets
                $pdfContent = $this->invoiceService->generateInvoice($order_id);

                $this->emailService->sendEmail(
                    $_SESSION['user']['email'],
                    "Haarlem Festival 2025 - Order Confirmation - Invoice #$order_id",
                    "<h1>Thank you for your order!</h1><p>Your order ID is: $order_id</p>",
                    $pdfContent,
                    "Invoice_$order_id.pdf"  // This is the filename that will appear in the email
                );

            } else {
                echo "Payment not completed.";
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo "Error retrieving session: " . $e->getMessage();
        }
    }
}
