<?php
require 'db.php';
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    if (!isset($_SESSION["email_id"])) {
        die("User not logged in.");
    }

    $email_id = $_SESSION["email_id"];

    // Sanitize inputs
    $make = $_POST['make'] ?? '';
    $model = $_POST['model'] ?? '';
    $reg = $_POST['reg'] ?? ''; // Reg now taken correctly from input
    $name = $make . " " . $model . " (" . $reg . ")";
    $description = $_POST['description'] ?? '';
    $price_per_day = floatval($_POST['price_per_day'] ?? 0);
    $caravan_address = $_POST['caravan_address'] ?? '';
    $caravan_postcode = $_POST['caravan_postcode'] ?? '';
    $mileage = intval($_POST['mileage'] ?? 0);
    $trans_type = $_POST['trans_type'] ?? '';
    $caravan_type = $_POST['caravan_type'] ?? '';

    // Handle image upload
    $image_url = '';
    if (isset($_FILES['caravanImage']) && $_FILES['caravanImage']['error'] === UPLOAD_ERR_OK) {
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

    // SQL insert
    $query = "INSERT INTO caravans 
        (name, description, price_per_day, image_url, caravan_address, caravan_postcode, mileage, make, model, trans_type, caravan_type, email_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ssdsssisssss", 
        $name, $description, $price_per_day, $image_url, $caravan_address, $caravan_postcode,
        $mileage, $make, $model, $trans_type, $caravan_type, $email_id
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
<title>Caravan Listing Form</title>
<link rel="stylesheet" href="pages\style\add-caravan.css">
<script defer src="pages\scripts\addCaravan.js"></script>
<body>
  <br>
  <br>
  <br>
  <br>
  <form class="form" id="caravan-form" method="POST" action="addCaravan.php" enctype="multipart/form-data">
    
      <h2>Create a caravan listing</h2>
      <br>
      <p>Enter caravan information that will appear on the listing.</p>
    

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
        <br>
        <p>Enter the registration of your caravan</p>
        <br>
        <div class="grid">
          <div class="col">
            <label for="reg">Registration Number</label>
            <input type="text" id="reg" name="name" required>
            <div class="error"></div>
          </div>
        </div>
        <div class="navigation">
          <button type="button" class="next">Next</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step">
        <h4>Caravan Details</h4>
        <br>
        <p>What is the bodytype of the caravan?</p>
        <br>
        <div class="grid">
          <div class="col">
            <div class="radio">
              <input type="radio" id="body-trailer" name="caravan_type" value="Trailer Caravan">
              <label for="body-trailer">Trailer Caravan</label>
              <div class="error"></div>
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
            <input type="text" id="make" name="make" >
            <div class="error"></div>
          </div>
          <div class="col">
            <label for="model">Model</label>
            <input type="text" id="model" name="model" >
            <div class="error"></div>
          </div>
          <div class="col">
            <label for="year">Year</label>
            <input type="number" id="year" name="year">
            <div class="error"></div>
          </div>
          <div class="col">
            <label for="mileage">Mileage</label>
            <input type="number" id="mileage" name="mileage">
            <div class="error"></div>
          </div>
      
          <div class="col">
            <p id="trans-text">Select transmission type</p>
            <br>
            <div class="radio">
              <input type="radio" id="trans-auto" name="trans_type" value="Automatic">
              <label for="trans-auto">Automatic</label>
              <input type="radio" id="trans-manual" name="trans_type" value="Manual">
              <label for="trans-manual">Manual</label>
              <div class="error"></div>
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
        </div>
        <div class="navigation">
          <button type="button" class="prev">Previous</button>
          <button type="button" class="next">Next</button>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step">
        <h4>Caravan Description</h4>
        <br>
          
        <p><label for="description">Tell us more about your caravan and what makes it special</label></p>
        <textarea name="description" id="description" rows="6" cols="60" ></textarea>
        <div class="error"></div>
        <br>
        <br>
        <p>Upload images of your caravan here</p>
        <input type="file" id="caravanImage" name="caravanImage" required>
        <div class="error"></div>
        <div class="navigation">
          <button type="button" class="prev">Previous</button>
          <button type="button" class="next">Next</button>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="step">
        <h4>Caravan Location</h4>
        <br>
          
        <p>Please tell us where the caravan is located</p>
        <br>
        <br>
        <div class="grid">
          <div class="col">
            <label for="address1">Address Line 1</label>
            <input type="text" id="address1" name="caravan_address" required>
            <div class="error"></div>
          </div>
          <div class="col">
            <label for="postcode">Postcode</label>
            <input type="text" id="postcode" name="caravan_postcode" required>
            <div class="error"></div>
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
        <br>
        <p>Please enter the price to rent the caravan per day</p>
        <br>
        <br>
        <div class="grid">
          <div class="col">
            <label for="price">Price per day</label>
            <input type="number" id="price" name="price_per_day" step="0.01" required>
            <div class="error"></div>
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
