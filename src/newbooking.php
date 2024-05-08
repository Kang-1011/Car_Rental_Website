<?php
ini_set('session.gc_maxlifetime', 3600); // set session timeout to 1 hour
session_set_cookie_params(3600); // set cookie timeout to 1 hour
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>New booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
    <script src="popup.js"></script>
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/styleex.css">
    <link rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="css/table.css">

    <style>
    #button-row {
        padding: 0;
        margin: auto;
        display: flex;
        justify-content: space-around;
    }
    </style>

    <script>
        function update(id) {
            var inputField = document.getElementById("car-id");
            inputField.value = id;

            var inputField2 = document.getElementById("car-id2");
            inputField2.value = id
        }
    </script>
</head>

<body>
    <div style="margin:20px;">
        <a href="bookings.php"><button class='button'>Back</button></a>
        <br><br>
        <?php
        $conn = new mysqli("localhost", "root", "", "carrental");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST['submit-date'])) {
            $pickup_date = $_POST['pickup-date'];
            $dropoff_date = $_POST['dropoff-date'];
            $_SESSION['pickup_date'] = $_POST['pickup-date'];
            $_SESSION['dropoff_date'] = $_POST['dropoff-date'];

            $date1 = DateTime::createFromFormat('Y-m-d', $pickup_date);
            $date2 = DateTime::createFromFormat('Y-m-d', $dropoff_date);
            $date_diff = $date1->diff($date2);
            $duration = $date_diff->days;
            $_SESSION['dateDiff'] = $duration;

            $dateObj1 = DateTime::createFromFormat('Y-m-d', $pickup_date);
            $formattedDate1 = $dateObj1->format('D, d M Y');
            $dateObj2 = DateTime::createFromFormat('Y-m-d', $dropoff_date);
            $formattedDate2 = $dateObj2->format('D, d M Y');
            
            if (empty($pickup_date) || empty($dropoff_date)) {
                echo "Please select a date";
            } else {
                echo "<h1>$formattedDate1 &nbsp; - &nbsp; $formattedDate2 [$duration day(s)]</h1>" ;
                echo "<br><h2 style='margin-bottom:5px'>Cars Available:</h2>";

                $sql = "SELECT * FROM cars WHERE CAR_ID NOT IN (SELECT DISTINCT CAR_ID FROM bookings WHERE (PICKUP_DATE < '$dropoff_date' AND DROPOFF_DATE > '$pickup_date') AND (STATUS != 'Cancelled')) AND STATUS = 'Active'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>
                        <thead>
                            <tr>
                                <th>Car ID</th>
                                <th>Car Name</th>
                                <th>Car Type</th>
                                <th>Seat Capacity</th>
                                <th>Price(per Day)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>";
                        echo $row['CAR_ID'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['CAR_NAME'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['CAR_TYPE'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['SEAT_CAPACITY'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['PRICE'];
                        echo "</td>";
                        echo "<td>";
                        echo "<button type='button' class='button' onclick='update($row[CAR_ID]); openPopUp()'><span>Book Car</span></button>";
                        echo "</td>";

                        echo "</tr>";
                    }

                    echo "</tbody>
                    </table>";
                } else {
                    echo "0 results";
                }
            }
        }
        $conn->close();
        ?>
        <div id="popup-container">
            <div class="popup">
                <h2>Book Car</h2>
                <div id="button-row">
                    <form method="post" action="order-confirmation1.php">
                        <input type="hidden" name="car-id" id="car-id" value="" required>
                        <input type="submit" name="new-customer-booking" value="New customer" style="width: 140px">
                    </form>
                    <form method="post" action="existing-customer.php">
                        <input type="hidden" name="car-id2" id="car-id2" value="" required>
                        <input type="submit" name="existing-customer-booking" value="Existing customer" style="width: 140px">
                    </form>
                </div>
                <button id="close-popup-button" onclick="closePopUp()">Close</button>
            </div>
        </div>
    </div>
</body>

</html>