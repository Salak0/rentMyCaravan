<?php
include('header.php');
require 'db.php';

if (!isset($_SESSION['email_id'])) {
    header("Location: login.php");
    exit;
}

$caravan_id = $_GET['id'] ?? null;
if (!$caravan_id) {
    die("Caravan ID is required.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];

    // Validate date range
    if (strtotime($end) <= strtotime($start)) {
        die("<h2>Invalid date range. Return date must be after start date.</h2>");
    }

    // Fetch caravan price and owner
    $stmt = $conn->prepare("SELECT price_per_day, email_id FROM caravans WHERE caravan_id = ?");
    $stmt->bind_param("i", $caravan_id);
    $stmt->execute();
    $stmt->bind_result($price_per_day, $owner_email);
    $stmt->fetch();
    $stmt->close();

    $customer_email = $_SESSION['email_id'];

    // Prevent owner from renting their own caravan
    if ($customer_email === $owner_email) {
        die("<h2>You cannot rent your own caravan.</h2>");
    }

    // Calculate total price
    $days = (strtotime($end) - strtotime($start)) / (60 * 60 * 24);
    if ($days < 1) $days = 1; // Minimum 1 day charge
    $total = $price_per_day * $days;

    // Insert into rentals
    $insert = $conn->prepare("INSERT INTO rentals (rental_id, email_id, caravan_id, loan_date, return_date, isReturned, total_price, customer_id) 
        VALUES (?, ?, ?, ?, ?, 0, ?, ?)");
    $rental_id = uniqid('rental_');
    $insert->bind_param("ssissds", $rental_id, $owner_email, $caravan_id, $start, $end, $total, $customer_email);

    if ($insert->execute()) {
        echo "<h2>Congratulations! You have rented the caravan from $start to $end for £$total</h2>";
    } else {
        echo "<h2>Rental failed: " . htmlspecialchars($insert->error) . "</h2>";
    }

    $insert->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rent Caravan</title>
    <link rel="stylesheet" href="pages\style\rentCaravan.css"> <!--linking the stylesheet-->

</head>
<body>
<div class="pageContainer">    <!--the outer container-->
    <div class="rentContainer"> <!--the inner container-->

        <h1>Select Dates for Rental</h1> <!--the title-->
        <form method="POST"> <!--the form -->
            <label for="start_date">Start Date:</label> <!--two date fields-->
            <input type="date" name="start_date" required><br><br>

            <label for="end_date">Return Date:</label>
            <input type="date" name="end_date" required><br><br>

            <button type="submit" id="confirmButton">Confirm Rental</button> <!--the submit button-->
        </form>
    </div>
</div>
</body>
</html>
