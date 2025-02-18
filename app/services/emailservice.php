<?php
namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include __DIR__ . '/../vendor/autoload.php';

class EmailService {

    public function sendPasswordResetEmail($email, $token) 
    {
        $mail = new PHPMailer(true);
        // Enable Debugging (for troubleshooting)
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


        $mail->setFrom("haarlemfestival2025@gmail.com", ); 
        $mail->addAddress($email); // This is the recipient's email address

        $mail->isHTML(true);
        $mail->Subject = "Password Reset";
        
        $mail->Body    = "Click <a href='localhost/resetPasswordThroughMailLink?token=$token'>here</a> to reset your password.";
    
        // Send Email
        if ($mail->send()) {
            error_log("Email sent successfully!");
        } else {
            error_log("Email not send: " . $mail->ErrorInfo);
        }
    
    }

}
?>
