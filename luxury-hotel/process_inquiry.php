<?php
require 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO inquiries (full_name, email, message_text) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            $_POST['full_name'],
            $_POST['email'],
            $_POST['message_text']
        ]);

        // --- NEW EMAIL NOTIFICATION CODE ---
        $to = "your-email@example.com"; // 1. Put your real email here
        $subject = "New Luxury Hotel Inquiry: " . $_POST['full_name'];
        
        $message = "You have received a new inquiry from your website.\n\n";
        $message .= "Name: " . $_POST['full_name'] . "\n";
        $message .= "Email: " . $_POST['email'] . "\n";
        $message .= "Message:\n" . $_POST['message_text'] . "\n\n";
        $message .= "View all inquiries: http://localhost/luxury-hotel/admin.php";

        $headers = "From: webmaster@luxuryhotel.com";

        // This sends the email
        mail($to, $subject, $message, $headers);
        // ------------------------------------

        echo "<h1>Inquiry Sent!</h1><p>We will contact you shortly.</p>";
        echo "<a href='contact.php'>Back</a> | <a href='admin.php'>View All Inquiries</a>";

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }