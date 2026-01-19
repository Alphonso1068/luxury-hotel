<?php
session_start();
// 1. Security Check
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require 'db_config.php';

// 2. Search Logic
$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search) {
    // Search by guest name or email
    $sql = "SELECT * FROM bookings WHERE guest_name LIKE ? OR email LIKE ? ORDER BY created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$search%", "%$search%"]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Default: Show all bookings
    $bookings = $pdo->query("SELECT * FROM bookings ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch all inquiries
$inquiries = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);

// Count totals for the summary cards
$total_bookings = count($bookings);
$confirmed_bookings = 0;
foreach($bookings as $b) { if($b['status'] == 'confirmed') $confirmed_bookings++; }
$total_inquiries = count($inquiries);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Luxury Hotel | Admin Dashboard</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; padding: 20px; }
        .section { background: white; padding: 25px; margin-bottom: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { color: #d4af37; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; border: 1px solid #eee; text-align: left; }
        th { background: #1a1a1a; color: white; }
        .status-confirmed { color: green; font-weight: bold; }
        .status-pending { color: orange; font-weight: bold; }
        .status-cancelled { color: red; font-weight: bold; }
        .btn-delete { color: #ff4d4d; text-decoration: none; }
        .logout { float: right; background: #ff4d4d; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>

    <a href="logout.php" class="logout">Logout</a>
    <h1>Hotel Management</h1>

    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
    <div style="flex: 1; background: #1a1a1a; color: white; padding: 20px; border-radius: 8px; text-align: center;">
        <h3 style="margin: 0; font-size: 0.9em; text-transform: uppercase; color: #d4af37;">Total Bookings</h3>
        <p style="margin: 10px 0 0; font-size: 2em; font-weight: bold;"><?php echo $total_bookings; ?></p>
    </div>
    
    <div style="flex: 1; background: white; border: 1px solid #ddd; padding: 20px; border-radius: 8px; text-align: center;">
        <h3 style="margin: 0; font-size: 0.9em; text-transform: uppercase; color: #666;">Confirmed</h3>
        <p style="margin: 10px 0 0; font-size: 2em; font-weight: bold; color: green;"><?php echo $confirmed_bookings; ?></p>
    </div>
    
    <div style="flex: 1; background: white; border: 1px solid #ddd; padding: 20px; border-radius: 8px; text-align: center;">
        <h3 style="margin: 0; font-size: 0.9em; text-transform: uppercase; color: #666;">New Inquiries</h3>
        <p style="margin: 10px 0 0; font-size: 2em; font-weight: bold; color: #d4af37;"><?php echo $total_inquiries; ?></p>
    </div>

</div>

    <button onclick="window.print()" style="float: right; margin-right: 10px; background: #1a1a1a; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">
    Print Report
</button>

<style>
    @media print {
    /* Add .summary-cards to your hide list */
    .logout, .btn-delete, form, button, .actions-column, .summary-cards {
        display: none !important;
    }
}
    @media print {
        /* Hide everything we don't want on paper */
        .logout, .btn-delete, form, button, .actions-column, th:last-child, td:last-child {
            display: none !important;
        }
        
        body { background: white; padding: 0; }
        .section { box-shadow: none; border: none; padding: 0; }
        h1, h2 { color: black; border-bottom: 1px solid #333; }
        
        table { border: 1px solid #333; }
        th { background: #eee !important; color: black !important; border: 1px solid #333; }
        td { border: 1px solid #333; }
    }
</style>

    <div class="section">
        <h2>Room Bookings</h2>
        
        <form method="GET" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="text" name="search" placeholder="Search name or email..." 
                   value="<?php echo htmlspecialchars($search); ?>" 
                   style="padding: 10px; width: 300px; border: 1px solid #ddd; border-radius: 4px;">
            <button type="submit" style="padding: 10px 20px; background: #d4af37; color: white; border: none; cursor: pointer; border-radius: 4px;">Search</button>
            <?php if($search): ?>
                <a href="admin.php" style="padding: 10px; color: #666; text-decoration: none;">Clear</a>
            <?php endif; ?>
        </form>

        <table>
    <tr>
        <th>Guest</th>
        <th>Room</th>
        <th>Dates</th>
        <th>Status</th>
        <th class="actions-column">Actions</th> </tr>
    <?php foreach ($bookings as $b): ?>
    <tr>
        <td><strong><?php echo htmlspecialchars($b['guest_name']); ?></strong><br><small><?php echo htmlspecialchars($b['email']); ?></small></td>
        <td><?php echo $b['room_type']; ?></td>
        <td><?php echo $b['check_in']; ?> to <?php echo $b['check_out']; ?></td>
        <td class="status-<?php echo $b['status']; ?>"><?php echo strtoupper($b['status']); ?></td>
        <td class="actions-column"> <a href="update_status.php?id=<?php echo $b['id']; ?>&status=confirmed" style="color: green; text-decoration: none;">Confirm</a> | 
            <a href="update_status.php?id=<?php echo $b['id']; ?>&status=cancelled" style="color: red; text-decoration: none;">Cancel</a> |
            <a href="delete.php?id=<?php echo $b['id']; ?>&type=booking" 
               onclick="return confirm('Delete permanently?')" class="btn-delete">Delete</a>
        </td>

        <td class="actions-column">

        <a href="reply_inquiry.php?email=<?php echo urlencode($b['email']); ?>&name=<?php echo urlencode($b['guest_name']); ?>" 
            style="color: #d4af37; text-decoration: none; font-weight: bold;">
            Reply by Email
</a>
        
    <a href="delete.php?id=<?php echo $i['id']; ?>&type=inquiry" 
        onclick="return confirm('Delete inquiry?')" class="btn-delete">Delete</a>
</td>
    </tr>
    <?php endforeach; ?>
</table>
    </div>

    <div class="section">
        <h2>Guest Inquiries</h2>
        <table>
            <tr>
                <th>From</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($inquiries as $i): ?>
            <tr>
                <td><strong><?php echo htmlspecialchars($i['full_name']); ?></strong><br><small><?php echo htmlspecialchars($i['email']); ?></small></td>
                <td><?php echo nl2br(htmlspecialchars($i['message_text'])); ?></td>
                <td><?php echo $i['created_at']; ?></td>
                <td>
                    <a href="delete.php?id=<?php echo $i['id']; ?>&type=inquiry" 
                    onclick="return confirm('Delete inquiry?')" class="btn-delete">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div>
    <label>Check-in</label>
    <input type="date" name="check_in" id="check_in" min="<?php echo date('Y-m-d'); ?>" required 
            style="width: 100%; padding: 10px;">
</div>
<div id="price-summary" style="background: #fdfaf0; border: 1px solid #d4af37; padding: 15px; margin-bottom: 20px; border-radius: 5px; display: none;">
    <p style="margin: 0; color: #1a1a1a;"><strong>Total Nights:</strong> <span id="total-nights">0</span></p>
    <p style="margin: 5px 0; font-size: 1.2em; color: #d4af37;"><strong>Total Cost: $<span id="total-cost">0</span></strong></p>
</div>
    </div>

    <script>
    function calculateTotal() {
        const roomType = document.querySelector('select[name="room_type"]').value;
        const checkIn = new Date(document.querySelector('input[name="check_in"]').value);
        const checkOut = new Date(document.querySelector('input[name="check_out"]').value);
        const priceBox = document.getElementById('price-summary');

        // Define your prices per night here
        const prices = {
            "Standard Room": 40,
            "Deluxe Room": 70,
            "Executive Room": 120,
        };

        if (checkIn && checkOut && checkOut > checkIn) {
            // Calculate difference in days
            const diffTime = Math.abs(checkOut - checkIn);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
            
            const totalCost = diffDays * (prices[roomType] || 0);

            // Show and update the box
            priceBox.style.display = 'block';
            document.getElementById('total-nights').innerText = diffDays;
            document.getElementById('total-cost').innerText = totalCost.toLocaleString();
        } else {
            priceBox.style.display = 'none';
        }
    }

    // Listen for changes on all inputs
    document.querySelector('select[name="room_type"]').addEventListener('change', calculateTotal);
    document.querySelector('input[name="check_in"]').addEventListener('change', calculateTotal);
    document.querySelector('input[name="check_out"]').addEventListener('change', calculateTotal);
</script>

    <script>
    // 1. Get the check-in and check-out input elements
    const checkInInput = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');

    // 2. Listen for when the guest picks a check-in date
    checkInInput.addEventListener('change', function() {
        if (this.value) {
            // 3. Set the minimum check-out date to be the same as check-in
            checkOutInput.min = this.value;
            
            // 4. If check-out was already set to an earlier date, clear it
            if (checkOutInput.value < this.value) {
                checkOutInput.value = '';
            }
        }
    });
</script>

</body>
</html>