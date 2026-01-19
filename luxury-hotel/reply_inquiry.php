<?php
// Include your PHPMailer files at the top
use PHPMailer\PHPMailer\PHPMailer;
require 'includes/PHPMailer/Exception.php';
require 'includes/PHPMailer/PHPMailer.php';
require 'includes/PHPMailer/SMTP.php';

$guest_email = $_GET['email'] ?? '';
$guest_name = $_GET['name'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'davisobure2022@gmail.com'; 
        $mail->Password = 'jqbk roxj gqvk lnla'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('davisobure2022@gmail.com', 'Luxury Hotel Concierge');
        $mail->addAddress($_POST['to_email']);
        $mail->Subject = "Regarding your inquiry at Luxury Hotel";
        $mail->Body = $_POST['message'];

        $mail->send();
        // This creates a popup box and redirects the browser
        echo "<script>
                alert('Success! Your reply has been sent to " . htmlspecialchars($guest_email) . "');
                window.location.href='admin.php';
        </script>";
    } catch (Exception $e) {
        // If it fails, show the error on the same page so you can troubleshoot
        echo "<div style='color: red; padding: 20px; border: 1px solid red;'>";
        echo "<strong>Message could not be sent.</strong><br>";
        echo "Mailer Error: {$mail->ErrorInfo}";
        echo "<br><br><a href='admin.php'>Back to Dashboard</a>";
        echo "</div>";
    }
}
?>

<div style="font-family: sans-serif; padding: 40px;">
    <h2>Reply to <?php echo htmlspecialchars($guest_name); ?></h2>
    <form method="POST">
        <input type="hidden" name="to_email" value="<?php echo htmlspecialchars($guest_email); ?>">
        <textarea name="message" rows="10" style="width: 100%; padding: 10px;" placeholder="Type your luxury response here..."></textarea><br><br>
        <button type="submit" 
        onclick="this.innerHTML='Sending...'; this.style.opacity='0.7';" 
        style="background: #d4af37; color: white; padding: 12px 25px; border: none; cursor: pointer; border-radius: 4px; font-weight: bold;">
    Send Email Now
</button>
    </form>
</div>