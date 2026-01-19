<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $room = $_POST['room'];
    $guests = $_POST['guests'];
    $message = $_POST['message'];

    $to = "yourhotel@email.com"; // CHANGE THIS
    $subject = "New Hotel Booking Request";

    $body = "
    Name: $name
    Email: $email
    Check-in: $checkin
    Check-out: $checkout
    Room Type: $room
    Guests: $guests
    Message: $message
    ";

    $headers = "From: $email";

    mail($to, $subject, $body, $headers);

    echo "Booking request sent successfully!";
}
?>