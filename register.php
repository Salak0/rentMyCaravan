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
    <link rel="stylesheet" href="pages/style/reg.css">
    <script defer src="scripts/reg.js"></script>
</head>
<body>
    <br>
    <br>
    <br>
    <br>
    <div class="main-reg">
        <div class="form-container">
            <form id="registration-form" action="register.php" method="POST">
                <a href="index.php" class="returnArrow"><img src="pages/style/returnArrow.svg" alt="Return"></a>
                <h2>Welcome!<br>Please Sign In</h2>
                <br>
                <br>
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" required>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" required>
                        <div class="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="postcode">Postcode:</label>
                        <input type="text" id="postcode" name="postcode" required>
                        <div class="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" required>
                        <div class="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        <div class="error"></div>
                    </div>

                    <div class="form-group">
                        <label for="repeatPassword">Repeat Password:</label>
                        <input type="password" id="repeatPassword" name="repeatPassword" required>
                        <div class="error"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <div class="checkbox-group">
                            <input type="checkbox" id="termsConditions" name="termsConditions" required>
                            <label for="termsConditions" style="display: inline; font-weight: normal;">
                                I agree to the Terms and Conditions
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <button type="submit" class="btn-register">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
