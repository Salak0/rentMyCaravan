<?php
session_start();
include('header.php');
?>

<!-- Caravan Listing Section -->
<section class="caravan-list">
    <h2 id="featcar">Featured Caravans</h2>
    <div class="caravan-container">
        <!-- Caravan 1 -->
        <div class="caravan-box">
            <img src="caravan1.jpg" alt="Caravan 1">
            <h3>Swift Elegance 2022</h3>
            <p>Beds: 4 | Bathrooms: 1 | Size: 25ft</p>
        </div>

        <!-- Caravan 2 -->
        <div class="caravan-box">
            <img src="caravan2.jpg" alt="Caravan 2">
            <h3>Bailey Phoenix 2021</h3>
            <p>Beds: 3 | Bathrooms: 1 | Size: 22ft</p>
        </div>

        <!-- Caravan 3 -->
        <div class="caravan-box">
            <img src="caravan3.jpeg" alt="Caravan 3">
            <h3>Elddis Avante 2023</h3>
            <p>Beds: 2 | Bathrooms: 1 | Size: 20ft</p>
        </div>
    </div>
</section>

<?php
include('footer.php'); // Optional if you have a footer
?>
</body>
</html>
