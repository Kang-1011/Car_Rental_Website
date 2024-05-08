<?php
ini_set('session.gc_maxlifetime', 3600); // set session timeout to 1 hour
session_set_cookie_params(3600); // set cookie timeout to 1 hour
session_start();

$car_id = $_SESSION['car_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="css/confirmation.css">
</head>

<body>
    <div class="main">
        <h1>Order Confirmation</h1>
        <div class="details-container"> <!-- div for pickup_date & dropoff_date -->
            <?php 
            $date1 = $_SESSION['pickup_date'];
            $date2 = $_SESSION['dropoff_date'];

            $dateObj1 = DateTime::createFromFormat('Y-m-d', $date1);
            $formattedDate1 = $dateObj1->format('D, d M Y');
            $dateObj2 = DateTime::createFromFormat('Y-m-d', $date2);
            $formattedDate2 = $dateObj2->format('D, d M Y');
            
            echo "<h2>$formattedDate1 &nbsp; - &nbsp; $formattedDate2</h2>";
            ?>
        </div>
        <div class="main-div">
            <div class="left-div"> <!-- main left div -->
                <div class="details-container">
                    <?php 
                    $conn = new mysqli("localhost", "root", "", "carrental");
                    if($conn->connect_error) {
                        die("Connection failed: ".$conn->connect_error);
                    }

                    $car_id = $_SESSION['car_id'];
                    $sql = "SELECT * FROM cars WHERE CAR_ID = $car_id";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<h3>Car Details</h3>";
                            echo "<h4>$row[CAR_NAME]</h4>";
                            echo "<p>Registration Number: $row[REGISTRATION_NUM]</p>";
                            echo "<p>Car Type: $row[CAR_TYPE]</p>";
                            echo "<ul>
                            <li>$row[SEAT_CAPACITY] seats</li>
                            <li>1 large bag</li>
                            <li>1 small bag</li>
                            <li>Unlimited mileage</li>
                            </ul>";
                            $car_price = $row['PRICE'];
                        }
                    }

                    if (isset($_POST['select-customer'])) {
                        $first_name = $_POST['first-name'];
                        $last_name = $_POST['last-name'];
                        $email = $_POST['email'];
                        $id_num = $_POST['id-num'];
                        $contact_num = $_POST['contact-num'];
                    }
                    ?>
                </div>
                <form method="post" action="receipt.php">
                    <div class="details-container">
                        <h3>Customer Details<span style="font-size: 13px; font-weight: normal;">(as appear on identity card)</span></h3>
                        <div class="form-rows">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" id="firstname" value="<?php echo $first_name ?>" readonly required><br>
                        </div>
                        <div class="form-rows">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" id="lastname" value="<?php echo $last_name ?>" readonly required><br>
                        </div>
                        <div class="form-rows">
                            <label for="id-num">Id Number</label>
                            <input type="text" id="id-num" name="id-num" value="<?php echo $id_num ?>" readonly required><br>
                        </div>
                        <div class="form-rows">
                            <label for="phone-num">Contact Number</label>
                            <input type="tel" id="contact-num" name="contact-num" value="<?php echo $contact_num ?>" readonly required><br>
                        </div>
                        <div class="form-rows">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" value="<?php echo $email ?>" readonly required><br>
                        </div>
                    </div>
                    <div class="details-container">
                        <h3>Payment Method</h3>
                        <div class="box">
                            <input type="radio" id="cash" name="payment-method" value="Cash" required>
                                <label for="cash">Cash</label><br>
                            <input type="radio" id="credit/debit-card" name="payment-method" value="Credit/Debit Card" required>
                                <label for="credit/debit-card">Credit/Debit Card</label><br>
                            <input type="radio" id="online-banking" name="payment-method" value="Online Banking" required>
                                <label for="online-banking">Online Banking</label><br>
                        </div>
                    </div>
                    <div id="button-row">
                        <button type="submit" class="button" id="book" name="book">Book Now</button>
                        <button type="button" class="button" onclick="window.location.href = 'bookings.php';">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="right-div"> <!-- main right div -->
                <div class="price-breakdown"> <!-- position: sticky -->
                    <h3>Car Price Breakdown</h3>
                    <div class="top-div">
                        <div class="inner-left-div">
                            <p>Car Rental Charges(per day)</p>
                            <p>Rental Duration</p>
                        </div>
                        <div class="inner-right-div">
                            <p><b><?php echo $car_price?></b></p>
                            <p>x &nbsp;&nbsp;&nbsp;<?php echo $_SESSION['dateDiff']?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="bottom-div">
                        <div class="inner-left-div">
                            <p>Price for <?php echo $_SESSION['dateDiff']?> day(s)</p>
                        </div>
                        <div class="inner-right-div">
                            <p><b><?php echo ($_SESSION['dateDiff'] * $car_price)?></b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    $conn->close();
?>