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
    <link rel="stylesheet" href="pages\style\index.css"> <!-- Adjust if your stylesheet has a different name -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>

<div class="main">
    <!-- Navigation bar -->
    <header class="header">
        <h2 class="logo">RentACaravan</h2>
        <div class="nav-links">
            

           
            <a href="login.php" class="nav-link">Login</a>
            <a href="register.php" class="nav-link">Register</a>
            
            <a href="index.php" class="nav-link">Home</a>
            <a href="listings.php" class="nav-link">Listings</a>
            <a href="aboutUs.php" class="nav-link">About Us</a>
            <?php if ($loggedIn):?>
                
                <a href="addCaravan.php" class="nav-link">Add Listing</a>
                <a href="myRentals.php" class="nav-link">My Rentals</a>
                <a href="myListings.php" class="nav-link">My Listings</a> 
            <?php else: ?>
                <a href="login.php" class="nav-link">Login</a>
                <a href="register.php" class="nav-link">Register</a>
            
            <?php endif; ?>

            <div class="nav-button">
                <?php if ($loggedIn): ?>
                    <span class="welcome-msg">Welcome, <?= htmlspecialchars($_SESSION["email_id"]); ?></span>
                    <a href="logout.php"><button type="button">Logout</button></a>
                <?php else: ?>
                    <button type="button" id="logBut" onclick="location.href='login.php'">
                        <span class="material-symbols-outlined">login</span>Login
                    </button>
                    <button type="button" id="regBut" onclick="location.href='register.php'">Register</button>
                <?php endif; ?>
            </div>

        </div>
        
    
    </header>
        
        
        
        


        <!-- Login/Register or Logout -->
       
    
    
</div>

<!-- Optional styling -->
<style>
    .nav-button.add-listing {
        background-color: #4CAF50;
        color: white;
        padding: 8px 14px;
        border-radius: 4px;
        text-decoration: none;
        margin-left: 10px;
    }

    .nav-button.add-listing:hover {
        background-color: #45a049;
    }
</style>
