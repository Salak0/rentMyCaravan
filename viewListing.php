<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';
include('header.php');

if (!isset($_GET['id'])) {
    echo "<p>Invalid listing.</p>";
    exit;
}

$caravanId = intval($_GET['id']);

$sql = "SELECT * FROM caravans WHERE caravan_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $caravanId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Caravan not found.</p>";
    exit;
}

$caravan = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($caravan['make'] . ' ' . $caravan['model']) ?> - Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2><?= htmlspecialchars($caravan['make'] . ' ' . $caravan['model']) ?></h2>
        <img src="<?= htmlspecialchars($caravan['image_url']) ?>" alt="Caravan Image" style="max-width:500px;">
        <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($caravan['description'])) ?></p>
        <p><strong>Mileage:</strong> <?= htmlspecialchars($caravan['mileage']) ?></p>
        <p><strong>Transmission:</strong> <?= htmlspecialchars($caravan['trans_type']) ?></p>
        <p><strong>Caravan Type:</strong> <?= htmlspecialchars($caravan['caravan_type']) ?></p>
        <p><strong>Beds:</strong> <?= htmlspecialchars($caravan['sleeps']) ?></p>
        <p><strong>Location:</strong> <?= htmlspecialchars($caravan['caravan_address']) ?></p>
        <p><strong>Price per day:</strong> £<?= htmlspecialchars($caravan['price_per_day']) ?></p>

        <?php if (isset($_SESSION['email_id'])): ?>
            <a href="rentCaravan.php?id=<?= $caravan['caravan_id'] ?>"><button>Rent this caravan</button></a>
        <?php else: ?>
            <p><a href="login.php">Login</a> to rent this caravan</p>
        <?php endif; ?>
    </div>
</body>
</html>
