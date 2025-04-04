<?php
namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include __DIR__ . '/../vendor/autoload.php';

class EmailService {

    public function sendEmail($email, $subject, $body, $attachment = null, $attachmentName = null)  // $attachment is optional
    {
        $mail = new PHPMailer(true);
        // Enable Debugging
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        // $mail->Debugoutput = 'html';
    
        // Gmail SMTP Settings
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = 'smtp.gmail.com';
        $mail->Username   = "haarlemfestival2025@gmail.com";  
        $mail->Password   = "ebytdttifpkfafde";    // Google App Password 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // Use 587 for TLS
        
        if ($attachment) {
            if (is_string($attachment) && file_exists($attachment)) {
                // It's a file path
                $mail->addAttachment($attachment);
            } else {
                // It's content data
                $fileName = $attachmentName ?? 'attachment.pdf';
                $mail->addStringAttachment($attachment, $fileName);
            }
        }


        $mail->setFrom("haarlemfestival2025@gmail.com", ); 
        $mail->addAddress($email); // This is the recipient's email address

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
    
        // Send Email
        if ($mail->send()) {
            error_log("Email sent successfully!");
        } else {
            error_log("Email not send: " . $mail->ErrorInfo);
        }
    
    }

}
?>
