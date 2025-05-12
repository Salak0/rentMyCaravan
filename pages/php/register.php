<?php
require('db.php');
include('header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (forename, surname, email_id, postcode, street_name, password)
            VALUES ('$firstName', '$lastName', '$email', '$postcode', '$address', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php"); // Redirect after successful registration
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="/website/css/reg.css">
    <script defer src="/website/css/reg.js"></script>
</head>
<body>
    <div class="main-reg">
        <div class="form-container">
            <form id="registration-form" action="dashboard.html" method="POST">
                <a href="index.html" class="returnArrow"><img src="style/returnArrow.svg"></a>
                <h2>Welcome! <br>Please Sign In</h2>

                <div class="form-row">
                    <!-- Left Column -->
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" >
                        <div class="error"></div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" >
                        <div class="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="dateOfBirth">Date of Birth:</label>
                        <input type="date" id="dateOfBirth" name="dateOfBirth" >
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number:</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" >
                        <div class="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" >
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="postcode">Postcode:</label>
                        <input type="text" id="postcode" name="postcode" >
                        <div class="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" >
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" >
                        <div class="error"></div>
                    </div>
                </div>
                
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" >
                        <div class="error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="repeatPassword">Repeat Password:</label>
                        <input type="password" id="repeatPassword" name="repeatPassword" >
                        <div class="error"></div>
                    </div>
                </div>                              

                <div class="form-row">
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="termsConditions" name="termsConditions" >
                            <label for="termsConditions" style="display: inline; font-weight: normal;">I agree to the Terms and Conditions</label>
                        </div>
                    </div>
                    <div class="form-group full-width">
                        <button type="submit" class="btn-register">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
