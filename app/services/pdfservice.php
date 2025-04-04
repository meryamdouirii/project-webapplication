<?php
namespace App\Services;
use App\Services\TicketService;
use App\Models\Ticket;
use App\Models\Session;
use App\Models\User;
use Dompdf\Dompdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PdfService {


    function generateTicket(Ticket $ticket, Session $session, User $user) {

        ob_start();

        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode(123, $generator::TYPE_CODE_128);  // Gebruik bijvoorbeeld het ticket-ID als barcode
        $barcodeBase64 = base64_encode($barcode);

        $logoPath = '/app/public/images-logos/logo.png';
        
        $dompdf = new Dompdf([
            "chroot" => '/app'
        ]);
        $html = file_get_contents("/app/views/ticket/ticket-template.html");

        $html = str_replace("{{ logo_image_url }}", $logoPath, $html);
        $html = str_replace("{{ customer_name }}", $user->getFirstName() ." ". $user->getLastName(), $html);
        $html = str_replace("{{ customer_email }}",$user->getEmail() ,$html);
        $html = str_replace("{{ customer_phone }}",$user->getPhoneNumber() ,$html);
        $html = str_replace("{{ event_name }}", $session->getName() ,$html);
        $html = str_replace("{{ event_date_time }}", $session->getDate() . " ". $session->getStartTime(),$html);
        $html = str_replace("{{ barcode_image_url }}", 'data:image/png;base64,' . $barcodeBase64, $html);
        $html = str_replace("{{ barcode_code }}", $ticket->getbarCode() ,$html);
        $html = str_replace("{{ ticket_price }}", $session->getPrice() ,$html);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        ob_end_clean();

        $pdfContent = $dompdf->output();

        return $pdfContent;
    }
}
