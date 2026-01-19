<?php
require 'db_config.php';
$inquiries = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inquiry Management</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #d4af37; color: white; }
    </style>
</head>
<body>
    <h2>Guest Inquiries</h2>
    <table>
        <tr>
            <th>Date</th><th>Name</th><th>Email</th><th>Message</th>
        </tr>
        <?php foreach ($inquiries as $i): ?>
        <tr>
            <td><?php echo $i['created_at']; ?></td>
            <td><?php echo htmlspecialchars($i['full_name']); ?></td>
            <td><?php echo htmlspecialchars($i['email']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($i['message_text'])); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>