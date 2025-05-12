<?php
session_start();
require('db.php');

// Check if the user is logged in
$loggedIn = isset($_SESSION["email_id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>RentACaravan</title>
    <link rel="stylesheet" href="/website/css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- Navigation bar -->
    <header class="header">
        <h2 class="logo">RentACaravan</h2>
        <div class="nav-links">
            <a href="login.php" class="nav-link">Login</a>
            <a href="register.php" class="nav-link">Register</a>
            <a href="index.php" class="nav-link">Home</a>
            <a href="listings.php" class="nav-link">Listings</a>
            <a href="aboutUs.php" class="nav-link">About Us</a>
            <?php if ($loggedIn): ?>
                <a href="addCaravan.php" class="nav-link">Add Listing</a>
                <a href="myRentals.php" class="nav-link">My Rentals</a>
                <a href="myListings.php" class="nav-link">My Listings</a> 
            <?php endif; ?>

            <div class="buttons">
            <?php if ($loggedIn): ?>
                <span class="welcome-msg">Welcome, <?= htmlspecialchars($_SESSION["email_id"]); ?></span>
                <a href="logout.php"><button type="button">Logout</button></a>
            <?php else: ?>
                <button type="button" class="login" onclick="location.href='login.php'">
                    <span class="material-symbols-outlined">login</span>Login
                </button>
                <button type="button" class="register" onclick="location.href='register.php'">Register</button>
            <?php endif; ?>
        </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="quote-container">
            <p class="quote-content">"A journey of a thousand miles<br>begins with a single click"</p>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="content-section">
        <section class="caravan-list">
            <h2 class="section-title">Featured Caravans</h2>
            <div class="caravan-container">
                <!-- Caravan 1 -->
                <div class="caravan-box">
                    <img src="style/caravan1.jpg" alt="Caravan 1">
                    <h3>Swift Elegance 2022</h3>
                    <p>Beds: 4 | Bathrooms: 1 | Size: 25ft</p>
                </div>

                <!-- Caravan 2 -->
                <div class="caravan-box">
                    <img src="style/caravan2.jpg" alt="Caravan 2">
                    <h3>Bailey Phoenix 2021</h3>
                    <p>Beds: 3 | Bathrooms: 1 | Size: 22ft</p>
                </div>

                <!-- Caravan 3 -->
                <div class="caravan-box">
                    <img src="style/caravan3.jpeg" alt="Caravan 3">
                    <h3>Elddis Avante 2023</h3>
                    <p>Beds: 2 | Bathrooms: 1 | Size: 20ft</p>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="mission-section">
            <h2 class="section-title">Our Mission</h2>
            <p class="mission-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Distinctio, at nulla. Repellendus nihil ad dolorum aliquid est, sed, soluta reiciendis eum eos inventore reprehenderit deleniti nam maxime explicabo! Voluptate, ratione.</p>
        </section>

        <!-- Instruction Section -->
        <section class="how-to-rent">
            <h2 class="section-title">How to Rent a Caravan</h2>
            <div class="steps-container">
                <div class="step-box">
                    <div class="step-number">1</div>
                    <h3>Browse Our Selection</h3>
                    <p>Browse through our selection of caravans and find one you'd like.</p>
                </div>
                <div class="step-box">
                    <div class="step-number">2</div>
                    <h3>Book Your Caravan</h3>
                    <p>Book the caravan by filling in some details.</p>
                </div>
                <div class="step-box">
                    <div class="step-number">3</div>
                    <h3>Pick Up</h3>
                    <p>Pick up the caravan from the agreed location.</p>
                </div>
                <div class="step-box">
                    <div class="step-number">4</div>
                    <h3>Begin Your Adventure</h3>
                    <p>Set off and enjoy your caravan adventure!</p>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 RentACaravan. All rights reserved.</p>
    </footer>
</body>
</html>