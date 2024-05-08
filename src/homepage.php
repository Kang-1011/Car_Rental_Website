<?php
ini_set('session.gc_maxlifetime', 3600); // set session timeout to 1 hour
session_set_cookie_params(3600); // set cookie timeout to 1 hour
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Car Rental Homepage</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/pstylep.css">

    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div id="container">

        <div id="navbar">
            <ul>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <li><a href="homepage.php">Home</a></li>
                <li><a href="bookings.php">Booking</a></li>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <li><a href="customers.php">Customers</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
        <div id="logo">
            <a href="homepage.php"><img src="Images/logo.png" alt=""></a>
        </div>
        <div id="bgimg">
            <img src="Images/ferrari.png" height="1100px" alt="">
        </div>
        <div id="contentSection">
            <h2 style="font-size: 115px;">Welcome </h2>
            <h2 style="font-size: 24px;">Active Admin:</h2>
            <h2 style="font-size: 24px; color: black; font-weight: bold;   ">
                <?php
                $id = $_SESSION['admin_id'];
                $conn = new mysqli("localhost", "root", "", "carrental");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT FIRST_NAME, LAST_NAME FROM admin WHERE ADMIN_ID = $id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $firstname = $row['FIRST_NAME'];
                        $lastname = $row['LAST_NAME'];
                    }
                }
                echo "" . $firstname . " " . $lastname;
                ?>
            </h2>
            <button onclick="window.location.href='cars.php';">Cars Inventory</button>
        </div>
</body>

</html>