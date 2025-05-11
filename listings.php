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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Available Caravans</h1>

<?php while ($row = $result->fetch_assoc()): ?>
    <div class="listing">
        <h2><?= htmlspecialchars($row['name']) ?></h2>
        <img src="<?= htmlspecialchars($row['image_url']) ?>" width="300">
        <p><?= htmlspecialchars($row['description']) ?></p>
        <p><strong>Mileage:</strong> <?= $row['mileage'] ?></p>
        <p><strong>Transmission Type:</strong> <?= $row['trans_type'] ?></p>
        <p><strong>Caravan Type:</strong> <?= $row['caravan_type'] ?></p>
        <p><strong>Price/day:</strong> £<?= $row['price_per_day'] ?></p>
        <?php if ($loggedIn): ?>
            <a href="rentCaravan.php?id=<?= $row['caravan_id'] ?>"><button>Rent this caravan</button></a>
        <?php else: ?>
            <p><a href="login.php">Login</a> to rent this caravan</p>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
</body>
</html>
