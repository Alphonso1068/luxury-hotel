<?php
// Show errors (for learning)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    echo "<h2>Inquiry Received</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Message:</strong><br>$message</p>";

} else {
    echo "Form not submitted correctly.";
}
?>
