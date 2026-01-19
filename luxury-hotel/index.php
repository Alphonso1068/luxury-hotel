<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotel | Home</title>
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="Luxury Hotel | Experience Elegance">
<meta property="og:description" content="Book your stay at the city's premier luxury destination.">
<meta property="og:image" content="https://yourdomain.com/images/hero-bg.jpg">
<meta property="og:url" content="https://yourdomain.com">
    
    <style>
        /* Base Styles */
        body { font-family: 'Poppins', sans-serif; background: #fdfaf6; margin: 0; padding: 0; }
        
        /* Navbar Styles */
        .main-navbar {
            background: #1a1a1a;
            color: white;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .logo h2 { margin: 0; color: white; }
        .logo span { color: #d4af37; }
        
        .nav-links { list-style: none; display: flex; gap: 20px; align-items: center; margin: 0; }
        .nav-links a { color: white; text-decoration: none; transition: 0.3s; }
        .nav-links a:hover { color: #d4af37; }
        
        .nav-btn {
            background: #d4af37;
            padding: 8px 20px;
            border-radius: 5px;
            color: #1a1a1a !important;
            font-weight: bold;
        }

        /* Booking Card Styles */
        .reservation-section { padding: 100px 20px; }
        .card { 
            background: white; 
            padding: 30px; 
            max-width: 500px; 
            margin: auto; 
            border: 1px solid #d4af37; 
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        input, select, textarea { width: 100%; margin: 10px 0; padding: 12px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #d4af37; color: white; border: none; padding: 15px; width: 100%; cursor: pointer; font-size: 1rem; font-weight: bold; transition: 0.3s; }
        button:hover { background: #b8962d; }

        /* Hamburger Icon Styles */
        .menu-toggle { display: none; flex-direction: column; cursor: pointer; gap: 5px; }
        .bar { width: 25px; height: 3px; background-color: #d4af37; transition: 0.3s; }

        /* Mobile Responsiveness */
        @media screen and (max-width: 768px) {
            .menu-toggle { display: flex; }
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 70px;
                right: 0;
                background: #1a1a1a;
                width: 100%;
                text-align: center;
                padding: 20px 0;
            }
            .nav-links.active { display: flex; }
            .nav-links li { margin: 15px 0; }
        }
    </style>
</head>
<body>

    <header class="main-navbar">
        <div class="logo">
            <h2>Luxury <span>Hotel</span></h2>
        </div>
        
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <nav>
            <ul class="nav-links" id="nav-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="#reservation-form" class="nav-btn">Book Now</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <div style="text-align:center; padding: 50px;">
        <h1>Welcome to Paradise</h1>
        <p>Scroll down or click 'Book Now' to start your journey.</p>
    </div>

    <section class="reservation-section" id="reservation-form">
        <div class="card">
            <h2 style="color:#d4af37; text-align:center;">Luxury Reservation</h2>
            <form action="process_booking.php" method="POST">
                <input type="text" name="guest_name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <select name="room_type">
                    <option value="Deluxe Room">Deluxe Room</option>
                    <option value="Standard Room">Standard Room</option>
                    <option value="Executive Suite">Executive Suite</option>
                </select>
                <label>Check-in</label>
                <input type="date" name="check_in" required>
                <label>Check-out</label>
                <input type="date" name="check_out" required>
                <textarea name="special_requests" placeholder="Any special requests?"></textarea>
                <button type="submit">Confirm Booking</button>
            </form>
        </div>
    </section>

    <script>
        const mobileMenu = document.getElementById('mobile-menu');
        const navList = document.getElementById('nav-list');

        mobileMenu.addEventListener('click', () => {
            navList.classList.toggle('active');
        });

        // Smooth scroll effect for the Book Now button
        document.querySelector('.nav-btn').addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if(target) {
                target.scrollIntoView({ behavior: 'smooth' });
                // Close mobile menu if open
                navList.classList.remove('active');
            }
        });
    </script>
</body>
</html>