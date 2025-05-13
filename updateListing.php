<?php
require('db.php');
session_start();

if (!isset($_SESSION["email_id"])) {
    header("Location: login.php");
    exit();
}

$caravanId = $_POST['caravan_id'];
$description = $_POST['description'];
$transType = $_POST['trans_type'];
$emailId = $_SESSION["email_id"];

// Handle file upload
$imagePath = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $imageName = basename($_FILES['image']['name']);
    $targetFile = $uploadDir . time() . "_" . $imageName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $imagePath = $targetFile;
    }
}

// Update the caravan
if ($imagePath) {
    $stmt = $conn->prepare("UPDATE caravans SET description=?, trans_type=?, image_url=? WHERE caravan_id=? AND email_id=?");
    $stmt->bind_param("sssis", $description, $transType, $imagePath, $caravanId, $emailId);
} else {
    $stmt = $conn->prepare("UPDATE caravans SET description=?, trans_type=? WHERE caravan_id=? AND email_id=?");
    $stmt->bind_param("ssis", $description, $transType, $caravanId, $emailId);
}

if ($stmt->execute()) {
    header("Location: myListings.php?msg=updated");
} else {
    echo "Update failed.";
}
