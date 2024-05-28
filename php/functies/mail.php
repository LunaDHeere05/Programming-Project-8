<?php
include '../sessionStart.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0;                                       // Zet op 0 om geen debug output te tonen
    $mail->isSMTP();                                            // Gebruik SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';                     // Mailtrap SMTP server
    $mail->SMTPAuth   = true;                                   // Activeer SMTP authenticatie
    $mail->Username   = 'f34344e8582f12';               // Mailtrap SMTP gebruikersnaam
    $mail->Password   = '62a8c5932291a4';               // Mailtrap SMTP wachtwoord
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Activeer TLS encryptie
    $mail->Port       = 587;                                    // TCP poort voor TLS

    // Ontvanger(s)
    $zender= 'admin@example.com';
    $ontvanger = $email;

    $mail->setFrom($zender, 'Admin');
    $mail->addAddress($ontvanger);           

    // Content
    $mail_onderwerp ='test-email';
    $mail_body ='Dit is de test-email';
    $mail_altbody ='This is the body in plain text for non-HTML mail clients';

    $mail->isHTML(true);                                        // Stel e-mail format in op HTML
    $mail->Subject = $mail_onderwerp;
    $mail->Body    = $mail_body;
    $mail->AltBody = $mail_altbody;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
