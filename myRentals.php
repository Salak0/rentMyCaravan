<?php
session_start();
require 'db.php';

if (!isset($_SESSION['email_id'])) {
    header("Location: login.php");
    exit;
}

$customer_id = $_SESSION['email_id'];

// Fetch rentals for this customer
$sql = "
    SELECT r.*, c.name, c.description, c.image_url, c.price_per_day
    FROM rentals r
    JOIN caravans c ON r.caravan_id = c.caravan_id
    WHERE r.customer_id = ?
    ORDER BY r.loan_date DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Rentals</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>My Rented Caravans</h1>

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="rental-item">
            <h2><?= htmlspecialchars($row['name']) ?></h2>
            <img src="<?= htmlspecialchars($row['image_url']) ?>" width="300">
            <p><?= htmlspecialchars($row['description']) ?></p>
            <p><strong>From:</strong> <?= $row['loan_date'] ?> | <strong>To:</strong> <?= $row['return_date'] ?></p>
            <p><strong>Total Price:</strong> £<?= $row['total_price'] ?></p>
            <p><strong>Status:</strong> <?= $row['isReturned'] ? 'Returned' : 'Ongoing' ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>You have not rented any caravans yet.</p>
<?php endif; ?>

</body>
</html>
