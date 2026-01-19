<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery | Luxury Hotel</title>
    <link rel="stylesheet" href="style.css"> <style>
        .gallery-container { padding: 50px 8%; text-align: center; }
        .gallery-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 20px; 
            margin-top: 30px;
        }
        .gallery-grid img { 
            width: 100%; 
            height: 250px; 
            object-fit: cover; 
            border-radius: 5px;
            transition: 0.3s;
        }
        .gallery-grid img:hover { transform: scale(1.05); }
    </style>
</head>
<body>
    <div class="gallery-container">
        <h1>Our Visual Story</h1>
        <p>Explore the elegance of our suites and facilities.</p>
        
        <div class="gallery-grid">
            <img src="images/hero-bg.jpg" alt="Lobby">
            <img src="images/standard-room.jpg" alt="Standard Room">
            <img src="images/deluxe-room.jpg" alt="Deluxe Room">
            <img src="images/executive-suite.jpg" alt="Executive Suite">
            <img src="images/swimming-pool.jpg" alt="Pool Area">
            <img src="images/restaurant.jpg" alt="Restaurant">
            <img src="images/lobby.jpg" alt="Hotel Lobby">
            <img src="images/room-interior.jpg" alt="Room Interior">
            <img src="images/hotel-view.jpg" alt="Hotel View">
            <img src="images/hotel-exterior.jpg" alt="Hotel Exterior">
            </div>
    </div>

    </body>
</html>