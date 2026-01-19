<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/PHPMailer/Exception.php';
require 'includes/PHPMailer/PHPMailer.php';
require 'includes/PHPMailer/SMTP.php';
require 'email_template.php'; 
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. COLLECT DATA
    $guest_name = $_POST['guest_name'];
    $email = $_POST['email'];
    $room_type = $_POST['room_type'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // 2. CHECK AVAILABILITY
    $check_sql = "SELECT COUNT(*) FROM bookings WHERE room_type = ? AND status != 'cancelled' AND (? < check_out AND ? > check_in)";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->execute([$room_type, $check_in, $check_out]);
    
    if ($check_stmt->fetchColumn() > 0) {
        die("<h2 style='color:red;'>Sorry! This room is already booked for these dates.</h2><a href='index.php'>Try again</a>");
    }

    // 3. IF AVAILABLE, INSERT INTO DATABASE
    $insert_sql = "INSERT INTO bookings (guest_name, email, room_type, check_in, check_out, status) VALUES (?, ?, ?, ?, ?, 'confirmed')";
    $insert_stmt = $pdo->prepare($insert_sql);
    
    if ($insert_stmt->execute([$guest_name, $email, $room_type, $check_in, $check_out])) {

        // 4. SEND EMAIL
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'davisobure2022@gmail.com'; // YOUR EMAIL
            $mail->Password   = 'jqbk roxj gqvk lnla';         // GMAIL APP PASSWORD
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('davisobure2022@gmail.com', 'Luxury Hotel Concierge');
            $mail->addAddress($email, $guest_name); 

            $mail->isHTML(true);
            $mail->Subject = 'Your Luxury Hotel Reservation';
            $mail->Body    = getBookingEmailHtml($guest_name, $room_type, $check_in);

            $mail->send();
            echo "<script>alert('Booking successful and confirmation email sent!'); window.location.href='index.php';</script>";
        } catch (Exception $e) {
            echo "Booking saved, but email failed. Mailer Error: {$mail->ErrorInfo}";
        }
    }
} // End of POST check
?>