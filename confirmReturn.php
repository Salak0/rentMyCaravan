<?php
session_start();
require('db.php');

if (!isset($_SESSION["email_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["caravan_id"])) {
    $caravanId = intval($_POST["caravan_id"]);
    $emailId = $_SESSION["email_id"];  // Get the logged-in user's email ID

    // Ensure the caravan belongs to the current user
    $check = $conn->prepare("SELECT * FROM caravans WHERE caravan_id = ? AND email_id = ?");
    $check->bind_param("is", $caravanId, $emailId);  // 'i' for integer, 's' for string
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Mark the rental as returned
        $stmt = $conn->prepare("UPDATE rentals SET isReturned = 1 WHERE caravan_id = ? AND isReturned = 0");
        $stmt->bind_param("i", $caravanId);  // 'i' for integer
        if ($stmt->execute()) {
            header("Location: myListings.php?return=success");
            exit();
        } else {
            echo "Error marking rental as returned.";
        }
    } else {
        echo "Caravan not found or you do not own it.";
    }
} else {
    echo "Invalid request.";
}
?>
