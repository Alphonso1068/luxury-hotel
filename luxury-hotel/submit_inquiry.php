<?php
$conn = new mysqli("localhost", "root", "", "hotelDB");

if ($conn->connect_error) {
    die("Database connection failed");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    $stmt = $conn->prepare(
        "INSERT INTO inquiries (name, email, phone, message) VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    // ✅ Redirect after success
    header("Location: thank_you.html");
    exit;
}
?>
