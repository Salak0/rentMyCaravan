<?php
require 'db.php';
include('header.php');

$loggedIn = isset($_SESSION['email_id']);

// Fetch all caravans
$sql = "SELECT * FROM caravans";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Caravan Listings</title>
    <link rel="stylesheet" href="pages\style\listings.css">

</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <br>
<h1>Available Caravans</h1>

<?php while ($row = $result->fetch_assoc()): ?>
    <a href="viewListing.php?id=<?= $row['caravan_id'] ?>" class="listing-link">
        <div class="listing">
       <h2><?= htmlspecialchars($row['make'] . ' ' . $row['model']) ?></h2>
            <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="Caravan Image">
            <p><strong>Mileage:</strong> <?= $row['mileage'] ?></p>
            <p><strong>Transmission Type:</strong><?= $row['trans_type'] ?></p>
            <p><strong>Price/day:</strong> £<?= $row['price_per_day'] ?></p>
        </div>
    </a>
<?php endwhile; ?>
</body>
</html>
