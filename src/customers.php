<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customers</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/pstylep.css">
    <link rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="css/table.css">

    <style>
        body {
            height: 100%;
            background-color: #eaf4fe;
        }

        #customer-id {
            margin-bottom: 10px;
            color: black;
            background-color: #eaf4fe; 
            font-size:17px; 
            border-top:black;
            border-left:black;
            border-right:black;
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
                <li><a href="adminlogin.php">Log out</a></li>
            </ul>
        </div>
        <div id="logo">
            <a href="homepage.php"><img src="Images/logo.png" alt=""></a>
        </div>

        <div style="margin-left: 20px; margin-right: 20px; margin-bottom: 20px;">
            <div>
                <br><br><br><br><br><br><br>
                <h1>All Customers</h1><br>
                <form action='retrieve-booking-history.php' method='post'>
                    <input type='text' id='customer-id' name='customer-id' placeholder="Enter customer id here">
                    <button type='submit' class='button' name='search-customer-by-id'><span>Search</span></button>
                </form>
            </div>
            <br>
            <?php
            $conn = new mysqli("localhost", "root", "", "carrental");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM customers";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Identification Number</th>
                                <th>Contact Number</th>
                                <th>PIC(Admin ID)</th>
                                <th>Booking History</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>";
                    echo $row['CUSTOMER_ID'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['FIRST_NAME'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['LAST_NAME'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['EMAIL'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['ID_NUM'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['CONTACT_NUM'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['ADMIN_ID'];
                    echo "</td>";
                    echo "<td>";
                    echo "<form method='post' action='retrieve-booking-history.php'>
                            <input type='hidden' name='cust-id' id='cust-id' value='$row[CUSTOMER_ID]'>
                            <input type='hidden' name='first-name' id='first-name' value='$row[FIRST_NAME]'>
                            <input type='hidden' name='last-name' id='last-name' value='$row[LAST_NAME]'>
                            <button class='button' type='submit' name='view-history' value='view'>
                                <span>View Details</span>
                            </button>  
                            </form>";
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody>
                    </table>";
            } else {
                echo "0 results";
            }
            $conn->close()
            ?>
        </div>
    <!-- </div> -->
</body>
</html>