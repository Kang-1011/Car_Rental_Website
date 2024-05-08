<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking History</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/pstylep.css">
    <link rel="stylesheet" href="css/table.css">

    <style>
        body {
            height: 100%;
            background-color: #eaf4fe;
        }

        th,
        td {
            text-align: left;
            padding: 20px;
        }
    </style>
</head>

<body>
    <!-- <div id="container"> -->
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

        <div style="margin-left: 20px; margin-right: 20px;">
            <br><br><br><br><br><br><br>
            <?php
            $conn = new mysqli("localhost", "root", "", "carrental");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['view-history']) || isset($_POST['search-customer-by-id'])) {
                if (isset($_POST['view-history'])) {
                    $customer_id = $_POST['cust-id'];
                    $first_name = $_POST['first-name'];
                    $last_name = $_POST['last-name'];
                }

                if (isset($_POST['search-customer-by-id'])) {
                    $customer_id = $_POST['customer-id'];

                    $sql1 = "SELECT * FROM customers WHERE CUSTOMER_ID = $customer_id";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            $first_name = $row1['FIRST_NAME'];
                            $last_name = $row1['LAST_NAME'];
                        }
                    }
                }
                $sql = "SELECT * FROM bookings WHERE CUSTOMER_ID = $customer_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h1>Booking History for " . $first_name . " " . $last_name . "</h1>";
                    echo "<br>";
                    echo "<table>
                        <thead>
                            <tr>
                                <th>Reservation ID</th>
                                <th>Car ID</th>
                                <th>Pick-up Date</th>
                                <th>Drop-off Date</th>
                                <th>Contact Number</th>
                                <th>Order Total</th>
                                <th>PIC(Admin ID)</th>
                                <th>Booking Date</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>";
                        echo $row['RESERVATION_ID'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['CAR_ID'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['PICKUP_DATE'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['DROPOFF_DATE'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['CUSTOMER_HP'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['ORDER_TOTAL'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['ADMIN_ID'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['BOOKING_DATE'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['STATUS'];
                        echo "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody>
                    </table>";
                } else {
                    echo "0 results";
                }
            }
            ?>
        </div>
    <!-- </div> -->
</body>
</html>