<?php
namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repositories\OrderRepository;

class InvoiceService {
    private OrderRepository $orderRepository;

    public function __construct() {
        $this->orderRepository = new OrderRepository();
    }
    
    public function generateInvoice(int $orderId): string {
        $orderData = $this->orderRepository->getOrderData($orderId);
        
        if (!$orderData) {
            throw new \Exception("Order not found");
        }

        $order = $orderData['order'];
        $payment = $orderData['payment'];

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $html = '<html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        h1 { color: #333; }
                        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                        .total { font-weight: bold; font-size: 1.2em; }
                    </style>
                </head>
                <body>
                    <h1>Invoice #'.$order->getId().'</h1>
                    <p>Date: '.date('Y-m-d').'</p>
                    <p>Customer: '.htmlspecialchars($order->getUser()->getFirstName().' '.$order->getUser()->getLastName()).'</p>
                    
                    <table>
                        <tr>
                            <th>Event</th>
                            <th>Session</th>
                            <th>Date/Time</th>
                            <th>Location</th>
                            <th>Price</th>
                        </tr>';

        foreach ($order->getTickets() as $ticket) {
            $session = $ticket->getSession();
            $html .= '<tr>
                        <td>'.htmlspecialchars($session->getDetailEventName()).'</td>
                        <td>'.htmlspecialchars($session->getName()).'</td>
                        <td>'.htmlspecialchars($session->getDateTimeStart()).'</td>
                        <td>'.htmlspecialchars($session->getLocation()).'</td>
                        <td>€'.number_format($session->getPrice(), 2).'</td>
                      </tr>';
        }

        $html .= '</table>
                 <div class="total">Total: €'.number_format($payment['amount'] / 100, 2).'</div>
                 <div>Payment Status: '.htmlspecialchars($payment['payment_status']).'</div>
                 </body>
                 </html>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }
}