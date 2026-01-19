<?php
function getBookingEmailHtml($guest_name, $room_type, $check_in) {
    return "
    <div style='font-family: serif; max-width: 600px; margin: auto; border: 1px solid #d4af37; padding: 20px;'>
        <div style='text-align: center;'>
            <h1 style='color: #d4af37; margin: 0;'>LUXURY HOTEL</h1>
            <p style='text-transform: uppercase; letter-spacing: 2px;'>Reservation Confirmed</p>
        </div>
        <hr style='border: 0; border-top: 1px solid #eee;'>
        <p>Dear <strong>$guest_name</strong>,</p>
        <p>Thank you for choosing Luxury Hotel. We are delighted to confirm your stay.</p>
        <div style='background: #f9f9f9; padding: 15px; border-radius: 5px;'>
            <p><strong>Room:</strong> $room_type</p>
            <p><strong>Check-in Date:</strong> $check_in</p>
        </div>
        <p>We look forward to welcoming you soon.</p>
        <p style='font-size: 0.8em; color: #888;'>123 Elite Ave, Luxury City | +1 234 567 890</p>
    </div>";
}
?>