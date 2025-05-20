<?php
require 'db.php';
include('header.php');

if (!isset($_SESSION['email_id'])) {
    header("Location: login.php");
    exit;
}

$customer_id = $_SESSION['email_id'];

// Show rentals for this customer
$sql = "SELECT r.rental_id, r.caravan_id, r.loan_date, r.return_date, r.isReturned, r.total_price,
               c.make, c.model, c.description, c.caravan_address, c.price_per_day
        FROM rentals r
        JOIN caravans c ON r.caravan_id = c.caravan_id
        WHERE r.customer_id = ? AND r.isReturned = 0";


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
    
<br>
    <br>
    <br>
    <br>
    <br>
     
<h1>My Rented Caravans</h1>

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="rental-item">
            <h2><?= htmlspecialchars($row['make']) ?></h2>
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
