<?php
include('header.php');
require 'db.php'; 

// Fetch 3 caravans
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
        <p class="mission-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </section>

    <!-- Instruction Section -->
        <section class="how-to-rent">
            <h2 class="section-title">How to Rent a Caravan</h2>
            <div class="steps-container">
                <div class="step-box">
                    <div class="step-number">1</div>
                    <h3>Browse Our Selection</h3>
                    <p>Browse through our selection of caravans and find one you'd like.</p>
                </div>
                <div class="step-box">
                    <div class="step-number">2</div>
                    <h3>Book Your Caravan</h3>
                    <p>Book the caravan by filling in some details.</p>
                </div>
                <div class="step-box">
                    <div class="step-number">3</div>
                    <h3>Pick Up</h3>
                    <p>Pick up the caravan from the agreed location.</p>
                </div>
                <div class="step-box">
                    <div class="step-number">4</div>
                    <h3>Begin Your Adventure</h3>
                    <p>Set off and enjoy your caravan adventure!</p>
                </div>
            </div>
        </section>

</div>

<?php include('footer.php'); ?>
