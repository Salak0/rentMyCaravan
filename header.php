<?php
session_start();
require('db.php');

// Check if the user is logged in
$loggedIn = isset($_SESSION["email_id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RentACaravan</title>
    <link rel="stylesheet" href="pages\style\index.css"> <!-- Linked Stylesheet -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>

<div class="main">
    <!-- Navigation bar -->
    <header class="header">
        <h2 class="logo">RentACaravan</h2>
        <div class="nav-links">
            
            <a href="index.php" class="nav-link">Home</a>
            <a href="listings.php" class="nav-link">Listings</a>
            <a href="aboutUs.php" class="nav-link">About Us</a>
            <?php if ($loggedIn):?>
                
                <a href="addCaravan.php" class="nav-link">Add Listing</a>
                <a href="myRentals.php" class="nav-link">My Rentals</a>
                <a href="myListings.php" class="nav-link">My Listings</a> 
        
            
            <?php endif; ?>
                <?php if ($loggedIn): ?>
                   <span class="welcome-msg" style="color:rgb(208, 221, 243); font-style: italic; font-weight: 400; margin-left: 20px;">
                         Welcome,<br> <?= htmlspecialchars($_SESSION["email_id"]); ?>
                    </span>
                    <div class="nav-button">
                        <button type="button" onclick="location.href='logout.php'">Log Out</button>
                    </div>
                <?php else: ?>
                    <div class="nav-button">
                        <button type="button" onclick="location.href='login.php'">Login</button>
                    </div>
                    <div class="nav-button">
                        <button type="button" onclick="location.href='register.php'" id="registerButton">Register</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>