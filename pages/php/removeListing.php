<?php
session_start();
require('db.php');

if (!isset($_SESSION["email_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["caravan_id"])) {
    $caravanId = intval($_POST["caravan_id"]);
    $emailId = $_SESSION["email_id"];

    // Only delete if the listing belongs to the logged-in user
    $stmt = $conn->prepare("DELETE FROM caravans WHERE caravan_id = ? AND email_id = ?");
    $stmt->bind_param("is", $caravanId, $emailId);
    $stmt->execute();

    header("Location: myListings.php");
    exit();
}
?>
