<?php
    $conn = new mysqli("localhost", "root", "", "carrental");
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    if (isset($_POST['search-reservation-by-id'])) {
        $reservation_id = $_POST['reservation-id'];
    }else {
        $reservation_id = $_GET['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Booking Details</title>
    <script src="popup.js"></script>
    <script src="setdate.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/pstylep.css">
    <link rel="stylesheet" href="css/buttons.css">

    <style>
        body {
            background-color: #eaf4fe;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #eaf4fe;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 2px solid #d40219;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        #button-row {
            padding: 1.5em;
            margin: auto;
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    <div id="navbar">
        <ul>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <li><a href="homepage.php">Home</a></li>
            <li><a href="bookings.php">Booking</a></li>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <li><a href="customers.php">Customers</a></li>
            <li><a href="adminlogin.php">Log Out</a></li>
        </ul>
    </div>
    <div id="logo">
        <a href="homepage.php"><img src="Images/logo.png" alt=""></a>
    </div>
    <br> <br> <br> <br> <br> <br> <br>
    <div class="container">
        <div id="booking-details">
            <?php
            $sql = "SELECT * FROM bookings where RESERVATION_ID = '$reservation_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<h3>Reservation Id: </h3>";
                    echo $row['RESERVATION_ID'];
                    echo "<h3><br>Car Id: </h3>";
                    echo $row['CAR_ID'];
                    echo "<h3><br>Pickup Date: </h3>";
                    echo $row['PICKUP_DATE'];
                    echo "<h3><br>Dropoff Date: </h3>";
                    echo $row['DROPOFF_DATE'];
                    echo "<h3><br>Customer Id: </h3>";
                    echo $row['CUSTOMER_ID'];
                    echo "<h3><br>Contact Number: </h3>";
                    echo $row['CUSTOMER_HP'];
                    echo "<h3><br>Order Total: </h3>";
                    echo $row['ORDER_TOTAL'];
                    echo "<h3><br>Booking Date: </h3>";
                    echo $row['BOOKING_DATE'];
                    echo "<h3><br>Status: </h3>";
                    echo $row['STATUS'];
                    echo "<h3><br>Last Edited: </h3>";
                    echo $row['LAST_EDITED'];
                    echo "<h3><br>Edited by(Admin ID): </h3>";
                    echo $row['ADMIN_ID'];

                    $car_id = $row['CAR_ID'];
                    $order_status = $row['STATUS'];
                    $date = $row['PICKUP_DATE'];
                }
            } else {
                echo "Error retrieving reservation details.";
                exit();
            }
            ?>
        </div>
        <?php
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $current_date = date('Y-m-d');

        if ($order_status == 'Confirmed' && (strtotime($current_date) < strtotime($date))) {
            echo "<div id='button-row'>
                    <button type='submit' class='button' name='update-reservation' id='update-reservation' onclick='openPopUp(); setPickupDate()'><span>Update Booking</span></button>
                    <form method='post'>
                        <button type='submit' class='button' name='cancel-reservation' id='cancel-reservation'><span>Cancel Booking</span></button>
                    </form>
                </div>";
        }
        ?>
        <div id="popup-container">
            <div class="popup">
                <h2>Change Reservation Date</h2>
                <div class="content">
                    <form method="post">
                        <label for="pickup-date">Pick-up Date:</label>
                        <input type="date" name="pickup-date" id="pickup-date" min="" onchange="setDropoffDate()" required>
                        <label for="dropoff-date">Drop-off Date:</label>
                        <input type="date" name="dropoff-date" id="dropoff-date" min="" required>
                        <input type="submit" name="check-availability" value="Check Availability">
                    </form>
                </div>
                <button id="close-popup-button" onclick="closePopUp()">Close</button>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['cancel-reservation'])) {
        echo "<script>";
        echo "if(confirm('Are you sure you want to cancel this reservation?')){";
        echo '    window.location.href = "cancel-reservation.php?reservation_id=' . $reservation_id . '";';
        echo "}";
        echo "</script>";
    }

    if (isset($_POST['check-availability'])) {
        $pickup_date = $_POST['pickup-date'];
        $dropoff_date = $_POST['dropoff-date'];

        $sql = "SELECT * FROM bookings WHERE (CAR_ID = '$car_id') AND (PICKUP_DATE < '$dropoff_date') AND (DROPOFF_DATE > '$pickup_date') AND (STATUS != 'Cancelled')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (($reservation_id == $row['RESERVATION_ID']) && ($pickup_date >= $row['PICKUP_DATE']) && ($dropoff_date <= $row['DROPOFF_DATE'])) {
                    echo "<script>";
                    echo "alert('Car is available on the selected date');";
                    echo "if(confirm('Do you want to proceed with the reservation update?')){";
                    echo '    window.location.href = "update-reservation.php?reservation_id=' . $reservation_id . '&pickup_date=' . $pickup_date . '&dropoff_date=' . $dropoff_date . ' ";';
                    echo "}";
                    echo "</script>";
                } else {
                    echo "<script>alert('Car is not available on the selected date')</script>";
                }
            }
        } else {
            echo "<script>";
            echo "alert('Car is available on the selected date');";
            echo "if(confirm('Do you want to proceed with the reservation update?')){";
            echo '    window.location.href = "update-reservation.php?reservation_id=' . $reservation_id . '&pickup_date=' . $pickup_date . '&dropoff_date=' . $dropoff_date . ' ";';
            echo "}";
            echo "</script>";
        }
    }
    ?>
</body>

</html>

<?php
$conn->close();
?>