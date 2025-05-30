<?php
include('header.php');
require('db.php');

if (!isset($_SESSION["email_id"])) {
    header("Location: login.php");
    exit();
}

$ownerEmail = $_SESSION["email_id"];

// Show caravans owned by the logged-in user with current rental status
$sql = "SELECT c.caravan_id, c.make, c.model, c.caravan_address, c.price_per_day,
               r.customer_id, r.loan_date, r.return_date, r.isReturned
        FROM caravans c
        LEFT JOIN rentals r ON c.caravan_id = r.caravan_id AND r.isReturned = 0
        WHERE c.email_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ownerEmail);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Listings</title>
    <link rel="stylesheet" href="pages\style\myListings.css">
</head>
<body>

    <br>
    <br>
    <br>
    <br>
    <br> 

<div class="container">
    <h2>My Caravan Listings</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="tableBody">
    <!--table titles-->
        <div class="rowTitles">
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Location</th>
                <th>Price/Day</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </div>
    
    <!--rows with values from database--> 
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="dataRow">
                    <td><?= htmlspecialchars($row["make"]) ?></td>
                    <td><?= htmlspecialchars($row["model"]) ?></td>
                    <td><?= htmlspecialchars($row["caravan_address"]) ?></td>
                    <td>£<?= htmlspecialchars($row["price_per_day"]) ?></td>
                    <td>
                        <?php if ($row["customer_id"]): ?>
                            <strong>Rented</strong><br>
                            by <?= htmlspecialchars($row["customer_id"]) ?><br>
                            From <?= date('d M Y', strtotime($row["loan_date"])) ?>
                            to <?= date('d M Y', strtotime($row["return_date"])) ?>
                        <?php else: ?>
                            Not Rented
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($row["customer_id"]): ?>
                            <!-- Confirm Return Button -->
                            <form method="POST" action="confirmReturn.php" style="margin-bottom: 5px;" onsubmit="return confirm('Confirm this caravan has been returned?');">
                                <input type="hidden" name="caravan_id" value="<?= $row['caravan_id'] ?>">
                                <button type="submit">Confirm Return</button>
                            </form>
                        <?php endif; ?>
            
                        <!-- Remove Listing -->
                        <div >
                            <form method="POST" action="removeListing.php" onsubmit="return confirm('Are you sure you want to remove this listing?');">
                                <input type="hidden" name="caravan_id" value="<?= $row['caravan_id'] ?>">
                                <button type="submit" class="navButtons">Remove</button>
                            </form>


                            <form method="GET" action="editListing.php">
                                <input type="hidden" name="caravan_id" value="<?= $row['caravan_id'] ?>">
                                <button type="submit" class="navButtons">Edit</button>
                            </form>
                        </div>
                    </td>

                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You haven't listed any caravans yet.</p>
    <?php endif; ?>
</div>

</body>
</html>
