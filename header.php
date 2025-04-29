<?php 

require('Config/connection.php');

// Check if the user is logged in
if(isset($_SESSION["email_id"])) {
    // If logged in, set the $loggedIn variable to true
    $loggedIn = true;
} else {
    // If not logged in, set the $loggedIn variable to false
    $loggedIn = false;
}

?>

<div class="main">
        <!-- Navigation bar -->
        <nav class="navbar">
            <div class="icon">
                <h2 class="logo">RentACaravan</h2>
                <div class="quote-container">
                    <p class="quote-content">"A journey of a thousand miles<br>begins with a single click"</p>
                </div>
            </div>
            <div class="buttons">
                <button type="button" class="login"><span class="material-symbols-outlined">
                    login
                    </span>Login</button>
                <button type="button" class="register">Register</button>
            </div>
        </nav>