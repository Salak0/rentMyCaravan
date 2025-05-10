<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and sanitize inputs
    $make = $_POST['make'] ?? '';
    $model = $_POST['model'] ?? '';
    $reg = $_POST['reg'] ?? '';
    $name = $make . " " . $model . " (" . $reg . ")";

    $description = $_POST['description'] ?? '';
    $price_per_day = $_POST['price_per_day'] ?? 0;
    $caravan_address = $_POST['caravan_address'] ?? '';
    $caravan_postcode = $_POST['caravan_postcode'] ?? '';
    $mileage = $_POST['mileage'] ?? 0;
    $trans_type = $_POST['trans_type'] ?? '';
    $caravan_type = $_POST['caravan_type'] ?? '';

    // Handle image upload
    $image_url = '';
    if (isset($_FILES['caravanImage']) && $_FILES['caravanImage']['error'] === 0) {
        $uploadDir = "uploads/";
        $fileName = uniqid() . "_" . basename($_FILES["caravanImage"]["name"]);
        $targetPath = $uploadDir . $fileName;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        if (move_uploaded_file($_FILES["caravanImage"]["tmp_name"], $targetPath)) {
            $image_url = $targetPath;
        }
    }

    // SQL insert statement
    $query = "INSERT INTO caravans 
    (name, description, price_per_day, image_url, caravan_address, caravan_postcode, mileage, make, model, trans_type, caravan_type) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ssdsssissss", 
        $name, $description, $price_per_day, $image_url, $caravan_address, $caravan_postcode,
        $mileage, $make, $model, $trans_type, $caravan_type
    );

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Caravan Listing Form</title>
  <link rel="stylesheet" href="style/add-caravan.css">
  <script defer src="scripts/addCaravan.js"></script>
</head>
<body>

<form class="form" method="POST" action="addCaravan.php" enctype="multipart/form-data">
  <div class="header">
    <h2>Create a caravan listing</h2>
    <p>Enter caravan information that will appear on the listing.</p>
  </div>

  <div class="body">
    <div class="pagination">
      <div class="number">1</div>
      <div class="bar"></div>
      <div class="number">2</div>
      <div class="bar"></div>
      <div class="number">3</div>
      <div class="bar"></div>
      <div class="number">4</div>
      <div class="bar"></div>
      <div class="number">5</div>
    </div>
  </div>

  <div class="steps">
    <!-- Step 1 -->
    <div class="step active">
      <h4>Caravan Registration</h4>
      <p>Enter the registration of your caravan</p>
      <div class="grid">
        <div class="col">
          <label for="reg">Registration Number</label>
          <input type="text" id="reg" name="name" required>
        </div>
      </div>
      <div class="navigation">
        <button type="button" class="next">Next</button>
      </div>
    </div>

    <!-- Step 2 -->
    <div class="step">
      <h4>Caravan Details</h4>
      <p>What is the bodytype of the caravan?</p>
      <br>
      <div class="grid">
        <div class="col">
          <div class="radio">
            <input type="radio" id="body-trailer" name="caravan_type" value="Trailer Caravan">
            <label for="body-trailer">Trailer Caravan</label>
          </div>
        </div>
        <div class="col">
          <div class="radio">
            <input type="radio" id="body-motorhome" name="caravan_type" value="Motorhome Caravan">
            <label for="body-motorhome">Motorhome Caravan</label>
          </div>
        </div>
        <div class="col">
          <label for="make">Make</label>
          <input type="text" id="make" name="make" required>
        </div>
        <div class="col">
          <label for="model">Model</label>
          <input type="text" id="model" name="model" required>
        </div>
        <div class="col">
          <label for="year">Year</label>
          <input type="number" id="year" name="year">
        </div>
        <div class="col">
          <label for="mileage">Mileage</label>
          <input type="number" id="mileage" name="mileage">
        </div>
        <div class="col">
          <p>Select transmission type</p>
          <div class="radio">
            <input type="radio" id="trans-auto" name="trans_type" value="Automatic">
            <label for="trans-auto">Automatic</label>
            <input type="radio" id="trans-manual" name="trans_type" value="Manual">
            <label for="trans-manual">Manual</label>
          </div>
        </div>
        <div class="col sleep-col">
          <div class="sleep">
            <label for="bed">Sleeps</label>
            <select name="bed" id="bed">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="more">8+</option>
            </select>
          </div>
        </div>
        <div class="col fuel-col">
          <div class="fuel">
            <label for="fuel">Fuel Type</label>
            <select id="fuel" name="fuel">
              <option value="Petrol">Petrol</option>
              <option value="Diesel">Diesel</option>
              <option value="LPG">LPG</option>
              <option value="Electric">Electric</option>
            </select>
          </div>
        </div>
      </div>
      <div class="navigation">
        <button type="button" class="prev">Previous</button>
        <button type="button" class="next">Next</button>
      </div>
    </div>

    <!-- Step 3 -->
    <div class="step">
      <h4>Caravan Description</h4>
      <p><label for="description">Tell us more about your caravan and what makes it special</label></p>
      <textarea name="description" id="description" rows="6" cols="60" required></textarea>
      <p>Upload images of your caravan here</p>
      <input type="file" id="caravanImage" name="caravanImage" required>
      <div class="navigation">
        <button type="button" class="prev">Previous</button>
        <button type="button" class="next">Next</button>
      </div>
    </div>

    <!-- Step 4 -->
    <div class="step">
      <h4>Caravan Location</h4>
      <p>Please tell us where the caravan is located</p>
      <div class="grid">
        <div class="col">
          <label for="address1">Address Line 1</label>
          <input type="text" id="address1" name="caravan_address" required>
        </div>
        <div class="col">
          <label for="postcode">Postcode</label>
          <input type="text" id="postcode" name="caravan_postcode" required>
        </div>
      </div>
      <div class="navigation">
        <button type="button" class="prev">Previous</button>
        <button type="button" class="next">Next</button>
      </div>
    </div>

    <!-- Step 5 -->
    <div class="step">
      <h4>Caravan Pricing</h4>
      <p>Please enter the price to rent the caravan per day</p>
      <div class="grid">
        <div class="col">
          <label for="price">Price per day</label>
          <input type="number" id="price" name="price_per_day" step="0.01" required>
        </div>
      </div>
      <div class="navigation">
        <button type="button" class="prev">Previous</button>
        <button type="submit">Submit</button>
      </div>
    </div>
  </div>
</form>

</body>
</html>
