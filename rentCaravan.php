<?php
session_start();
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

    // Calculate days and price
    $stmt = $conn->prepare("SELECT price_per_day, email_id FROM caravans WHERE caravan_id = ?");
    $stmt->bind_param("i", $caravan_id);
    $stmt->execute();
    $stmt->bind_result($price_per_day, $owner_email);
    $stmt->fetch();
    $stmt->close();

    $days = (strtotime($end) - strtotime($start)) / (60 * 60 * 24);
    $total = $price_per_day * $days;

    // Insert into rentals
    $insert = $conn->prepare("INSERT INTO rentals (rental_id, email_id, caravan_id, loan_date, return_date, isReturned, total_price, customer_id) 
        VALUES (?, ?, ?, ?, ?, 0, ?, ?)");
    $rental_id = uniqid('rental_');
    $customer_email = $_SESSION['email_id'];
    $insert->bind_param("ssissds", $rental_id, $owner_email, $caravan_id, $start, $end, $total, $customer_email);
    $insert->execute();

    echo "<h2>Congratulations! You have rented the caravan from $start to $end for £$total</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rent Caravan</title>
</head>
<body>
<h1>Select Dates for Rental</h1>
<form method="POST">
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" required><br><br>

    <label for="end_date">Return Date:</label>
    <input type="date" name="end_date" required><br><br>

    <button type="submit">Confirm Rental</button>
</form>
</body>
</html>
