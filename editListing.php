<?php
include('header.php');
require('db.php');

if (!isset($_SESSION["email_id"])) {
    header("Location: login.php");
    exit();
}

$ownerEmail = $_SESSION["email_id"];

if (!isset($_GET['caravan_id'])) {
    echo "Caravan ID missing.";
    exit();
}

$caravanId = $_GET['caravan_id'];

// Fetch existing caravan data
$sql = "SELECT * FROM caravans WHERE caravan_id = ? AND email_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $caravanId, $ownerEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Caravan not found or you do not have permission.";
    exit();
}

$caravan = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $make = $_POST["make"];
    $model = $_POST["model"];
    $mileage = $_POST["mileage"];
    $price_per_day = $_POST["price_per_day"];
    $description = $_POST["description"];
    $trans_type = $_POST["trans_type"];
    
    // Handle image upload
    if (!empty($_FILES["image"]["name"])) {
        $imageName = basename($_FILES["image"]["name"]);
        $targetPath = "uploads/" . $imageName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
    } else {
        $targetPath = $caravan["image_url"]; // Keep old image
    }

    $updateSql = "UPDATE caravans SET make = ?, model = ?, mileage = ?, price_per_day = ?, description = ?, trans_type = ?, image_url = ? WHERE caravan_id = ? AND email_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssddsssis", $make, $model, $mileage, $price_per_day, $description, $trans_type, $targetPath, $caravanId, $ownerEmail);

    if ($updateStmt->execute()) {
        echo "<script>alert('Listing updated successfully'); window.location.href = 'myListings.php';</script>";
        exit();
    } else {
        echo "Error updating listing: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Listing</title>
    <link rel="stylesheet" href="pages\style\editListing.css">

</head>
<body>
    <div class="outerContainer">
        <!--title-->
        <h2 id="listingTitle">Edit Caravan Listing</h2> 

        <!--form fields -->
        <form method="POST" enctype="multipart/form-data" class="container"> 
            <label>Make:</label>
            <input class="inpField" type="text" name="make" value="<?= htmlspecialchars($caravan['make']) ?>" required>

            <label>Model:</label>
            <input class="inpField" type="text" name="model" value="<?= htmlspecialchars($caravan['model']) ?>" required>

            <label>Mileage:</label>
            <input class="inpField" type="number" name="mileage" value="<?= htmlspecialchars($caravan['mileage']) ?>" required>

            <label>Price per Day (£):</label>
            <input class="inpField" type="number" step="0.01" name="price_per_day" value="<?= htmlspecialchars($caravan['price_per_day']) ?>" required>

            <label>Description:</label>
            <textarea name="description" required><?= htmlspecialchars($caravan['description']) ?></textarea>

            <label>Transmission Type:</label>
            <select name="trans_type" required>
                <option value="Manual" <?= $caravan['trans_type'] == 'Manual' ? 'selected' : '' ?>>Manual</option>
                <option value="Automatic" <?= $caravan['trans_type'] == 'Automatic' ? 'selected' : '' ?>>Automatic</option>
            </select><br><br>

            <!---submitting image component-->
            <label>Image:</label>
            <input type="file" name="image"><br> 
            <small>Current Image: <?= htmlspecialchars($caravan['image_url']) ?></small><br><br>

            <button type="submit" class="navButtons">Update Listing</button>
        </form>
    </div>
</body>
</html>
