<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { exit; }
require 'db_config.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    
    // Allowed statuses for security
    $allowed = ['pending', 'confirmed', 'cancelled'];
    
    // CORRECTED FUNCTION: in_array
    if (in_array($status, $allowed)) {
        $stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }
}

header("Location: admin.php");
exit;
?>