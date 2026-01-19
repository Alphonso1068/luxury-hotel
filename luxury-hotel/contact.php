<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Inquiry | Luxury Hotel</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 50px; }
        .card { background: white; padding: 25px; max-width: 500px; margin: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-top: 5px solid #d4af37; }
        h2 { color: #1a1a1a; }
        input, textarea { width: 100%; margin: 10px 0; padding: 12px; box-sizing: border-box; border: 1px solid #ccc; }
        button { background: #d4af37; color: white; border: none; padding: 12px; width: 100%; cursor: pointer; font-weight: bold; }
        button:hover { background: #b8952e; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Send an Inquiry</h2>
        <form action="process_inquiry.php" method="POST">
            <input type="text" name="full_name" placeholder="Your Full Name" required>
            <input type="email" name="email" placeholder="Your Email Address" required>
            <textarea name="message_text" rows="5" placeholder="How can our concierge assist you?" required></textarea>
            <button type="submit">Submit Inquiry</button>
        </form>
    </div>
</body>
</html>