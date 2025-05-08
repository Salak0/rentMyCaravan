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
    <link rel="stylesheet" href="styles.css"> <!-- Adjust if your stylesheet has a different name -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>

<div class="main">
    <!-- Navigation bar -->
    <nav class="navbar">
        <div class="icon">
            <h2 class="logo">RentACaravan</h2>
            <div class="quote-container">
                <p class="quote-content">"A journey of a thousand miles<br>begins with a single click"</p>
            </div>
        </div>

        <!-- New navigation links -->
        <div class="nav-links">
            <a href="index.php" class="nav-button">Home</a>
            <a href="listings.php" class="nav-button">Listings</a>
            <a href="aboutUs.php" class="nav-button">About Us</a>
        </div>

        <!-- Login/Register or Logout -->
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
    </nav>
