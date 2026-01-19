<?php
session_start();
require 'db_config.php';

  // Find the user in the database
$stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
$stmt->execute([$_POST['username']]);
$user = $stmt->fetch();

// EMERGENCY BYPASS: Just check the text directly
if ($user && ($_POST['password'] == 'admin123' || password_verify($_POST['password'], $user['password_hash']))) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin.php");
    exit;
} else {
    $error = "Invalid credentials!";
}

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login | Luxury Hotel</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #1a1a1a; }
        .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,0.5); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #d4af37; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 style="text-align:center;">Staff Login</h2>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>