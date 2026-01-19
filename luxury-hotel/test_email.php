<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'includes/PHPMailer/Exception.php';
require 'includes/PHPMailer/PHPMailer.php';
require 'includes/PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;
    $mail->Username   = 'davisobure2022@gmail.com';      // Your Gmail address
    $mail->Password   = 'jqbk roxj gqvk lnla';       // Your 16-digit App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('alphonsodavis1068@gmail.com', 'Hotel Test');
    $mail->addAddress('alphonsodavis1068@gmail.com');       // Send it to yourself
    
    $mail->isHTML(true);
    $mail->Subject = 'PHPMailer Working!';
    $mail->Body    = '<h1>Success!</h1><p>Your XAMPP server sent a real email.</p>';

    $mail->send();
    echo 'Message has been sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>