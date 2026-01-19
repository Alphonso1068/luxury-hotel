<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { exit; }
require 'db_config.php';

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $table = ($_GET['type'] == 'booking') ? 'bookings' : 'inquiries';
    
    $stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: admin.php"); // Redirect back to admin.php
exit;
?>