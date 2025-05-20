<?php
require('db.php'); 
include('header.php');

$loginError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitizing the inputs
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['email_id'] = $user['email_id'];
            header("Location: index.php"); 
            exit();
        } else {
            $loginError = "Invalid password.";
        }
    } else {
        $loginError = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - RentACaravan</title>
    <link rel="stylesheet" href="pages/style/login.css">
    <script defer src="pages/scripts/logi.js"></script>
</head>
<body>
    <div class="main-login">
        <div class="login-container">
            <a href="index.php" class="returnArrow"><img src="pages\style\returnArrow.svg"></a>
            <h2>Welcome! <br>Please Sign In</h2>
            <form id="login-form" method="POST" action="">
                <div class="inputValidation">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email">
                    <div class="error"></div>
                </div>
                <div class="inputValidation">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <div class="error"></div>
                </div>
                <?php if ($loginError): ?>
                <p style="color:red;"><?php echo $loginError; ?></p>
            <?php endif; ?>
                <button type="submit" class="button">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>
