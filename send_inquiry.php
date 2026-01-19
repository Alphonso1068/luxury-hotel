<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = "yourhotel@email.com"; // CHANGE THIS
    $mail_subject = "New Hotel Inquiry";

    $body = "
    Name: $name
    Email: $email
    Phone: $phone
    Subject: $subject
    Message: $message
    ";

    $headers = "From: $email";

    mail($to, $mail_subject, $body, $headers);

    echo "Inquiry sent successfully!";
}
?>
