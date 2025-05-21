<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RentACaravan</title>
    <link rel= "stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header class="header">
        <h2 class="logo">RentACaravan</h2>
        <div class="nav-links">
            <a href="login.php" class="nav-link">Login</a>
            <a href="register.php" class="nav-link">Register</a>
            <a href="index.php" class="nav-link">Home</a>
            <a href="aboutUs.php" class="nav-link">About Us</a>
        </div>
    </header>

    <div class="AboutUsPage">

        <div id="HeadingBorder">
            <h1 id="PageTitle"><a href="index.html">RentMyCaravan</a></h1>
        </div>

        <div id="text-body">
            <h2 id="AboutUsTitle">About Us</h2>
            <div class="section-flex">
                <p id="AboutUsIntro">
                    Rent my caravan has been the UK's No.1 caravan renting site for 15 years,
                    thanks to our family values that we have been incorporating throughout 
                    our business. It started in 2005 when Eddie Bican, the founder of RentMyCaravan,
                    was trying to find a way to keep his prized caravan instead of selling it.
                </p>
            </div>
        </div>

        
        <div class="content-container card-container">
            <div class="section-flex">
                <div>
                    <h5 id="OurValuesTitle">Our Values</h5>
                    <p id="OurValues">
                        At RentMyCaravan, our core values revolve around creating the most seamless
                         connection between sellers and buyers. We’re dedicated to delivering a smooth,
                        enjoyable experience for everyone involved. Whether you're listing your caravan
                        or looking to hire one, you can count on us to get it right—every time. 
                        For buyers and sellers alike, RentMyCaravan is where convenience meets trust.
                    </p>
                    <img src="pages/style/oldPeopleWIthCaravan.jpg" alt="Elderly with Caravan">
                </div>
            </div>
        </div>

        
        <div class="content-container card-container">
            <div class="section-flex">
                <div>
                    <h5 id="OurCompanyTitle">Our Company</h5>
                    <p id="OurCompany">
                        Our mission is to seamlessly connect sellers with buyers through a smooth, 
                        hassle-free experience. We're committed to delivering exceptional customer 
                        service and fostering lasting trust within the caravan community—bringing people
                         together through reliability, transparency, and shared passion for life on the road.
                    </p>
                    <img src="pages/style/elderlyOurValuesPage.jpg" alt="Company Image">
                </div>
            </div>
        </div>

    </div>
</body>

</html>
