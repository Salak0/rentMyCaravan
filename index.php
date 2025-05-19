<?php
include('header.php');
require 'db.php'; // Make sure this connects to your MySQL database

// Fetch 3 random caravans
$sql = "SELECT caravan_id, make, model, sleeps, image_url FROM caravans ORDER BY RAND() LIMIT 3";
$result = $conn->query($sql);
?>

<link rel="stylesheet" href="pages/style/index.css">

<!-- Hero Section -->
<div class="hero-section">
    <div class="quote-container">
        <p class="quote-content">"A journey of a thousand miles<br>begins with a single click"</p>
    </div>
</div>

<!-- Main Content -->
<div class="content-section">
    <section class="caravan-list">
        <h2 class="section-title">Featured Caravans</h2>
        <div class="caravan-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="caravan-box">
                    <a href="viewListing.php?id=<?= $row['caravan_id'] ?>">
                        <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['make'] . ' ' . $row['model']) ?>">
                        <h3><?= htmlspecialchars($row['make'] . ' ' . $row['model']) ?></h3>
                        <p>Sleeps: <?= htmlspecialchars($row['sleeps']) ?></p>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <h2 class="section-title">Our Mission</h2>
        <p class="mission-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit...</p>
    </section>



</div>

<?php include('footer.php'); ?>
