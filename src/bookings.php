<!DOCTYPE html>

<head>
    <html lang="en">
    <meta charset="UTF-8">
    <title>Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
    <script src="popup.js"></script>
    <script src="setdate.js"></script>
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/pstylep.css">
    <link rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/tab.css">
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
            <li><a href="adminlogin.php">Log Out </a></li>
        </ul>
    </div>
    <div id="logo">
        <a href="homepage.php"><img src="Images/logo.png" alt=""></a>
    </div>
    <div class="tabf">
        <br><br><br><br><br><br><br><br>

        <div class="tab">
            <button id="open-popup-button" onclick="openPopUp(); setPickupDate()">+ New Booking</button>
            <button class="button" onclick="openTab(event, 'all-reservations')">All Reservations</button>
            <button class="button" onclick="openTab(event, 'customers')">Customers</button>
            <button class="button" onclick="openTab(event, 'S-and-A')">Status and Admin</button>
            <button class="button" onclick="openTab(event, 'P-and-D')">Pickup and Dropoff</button>
        </div>
        <br>
        <div id="popup-container">
            <div class="popup">
                <h2>New Reservation</h2>
                <form action="newbooking.php" method="post">
                    <label for="pickup-date">Pick-up Date:</label>
                    <input type="date" name="pickup-date" id="pickup-date" min="" onchange="setDropoffDate()"
                        required>
                    <label for="dropoff-date">Drop-off Date:</label>
                    <input type="date" name="dropoff-date" id="dropoff-date" min="" required>
                    <input type="submit" name="submit-date" value="Next">
                </form>
                <button id="close-popup-button" onclick="closePopUp()">Close</button>
            </div>
        </div>
        <!-- All information tab-->
        <div id="all-reservations" class="tabcontent">
            <h1>All Reservations Information </h1>
            <form action='booking-details.php' method='post'>
                <input type='text' id='reservation-id' name='reservation-id'
                    style="margin-bottom: 10px;color: black;background-color: #eaf4fe; font-size:17px; border-top:black;border-left:black;border-right:black; "
                    placeholder="&nbsp &nbsp Enter reservation ID">
                <button class='button' type='submit' name='search-reservation-by-id'
                    value='Search by Reservation Id' style='padding: 5px 10px; font-size: 14px;'>
                    <span>Search</span>
                </button>
            </form>
            <?php
            $conn = new mysqli("localhost", "root", "", "carrental");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM bookings";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                            <thead>
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Car ID</th>
                                    <th>Pick-up Date</th>
                                    <th>Drop-off Date</th>
                                    <th>Customer ID</th>
                                    <th>Contact Number</th>
                                    <th>Order Total</th>
                                    <th>Booking Date</th>
                                    <th>Order Status</th>
                                    <th>Edited by(Admin ID)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>";
            }

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
                echo $row['CUSTOMER_ID'];
                echo "</td>";
                echo "<td>";
                echo $row['CUSTOMER_HP'];
                echo "</td>";
                echo "<td>";
                echo $row['ORDER_TOTAL'];
                echo "</td>";
                echo "<td>";
                echo $row['BOOKING_DATE'];
                echo "</td>";
                echo "<td>";
                echo $row['STATUS'];
                echo "</td>";
                echo "<td>";
                echo $row['ADMIN_ID'];
                echo "</td>";

                echo "<td>";
                echo "<form action='booking-details.php?id=$row[RESERVATION_ID]' method='post'>
                        <button class='button' type='submit' name='booking-details'>
                        <span>Check Details</span>
                        </button>
                                </form>";
                echo "</td>";
                echo "</tr>";
            }


            $conn->close()
                ?>
            </tbody>
            </table>
            <br><br>
        </div><!-- Customers information tab-->
        <div id="customers" class="tabcontent">
            <h1>Customer's Information </h1>
            <form action='booking-details.php' method='post'>
                <input type='text' id='reservation-id' name='reservation-id'
                    style="margin-bottom: 10px;color: black;background-color: #eaf4fe; font-size:17px; border-top:black;border-left:black;border-right:black; "
                    placeholder="&nbsp &nbsp Enter reservation ID">
                <button class='button' type='submit' name='search-reservation-by-id'
                    value='Search by Reservation Id' style='padding: 5px 10px; font-size: 14px;'>
                    <span>Search</span>
                </button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th width="20%">Reservation ID</th>
                        <th width="20%">Car ID</th>
                        <th width="20%">Customer ID</th>
                        <th width="20%">Contact Number</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "carrental");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM bookings";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td width='20%'>" . $row['RESERVATION_ID'] . "</td>";
                            echo "<td width='20%'>" . $row['CAR_ID'] . "</td>";
                            echo "<td width='20%'>" . $row['CUSTOMER_ID'] . "</td>";
                            echo "<td width='20%'>" . $row['CUSTOMER_HP'] . "</td>";
                            echo "<td width='20%'>";
                            echo "<form action='booking-details.php?id=$row[RESERVATION_ID]' method='post'>";
                            echo "<button class='button' type='submit' name='booking-details'>";
                            echo "<span>Check Details</span>";
                            echo "</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
            <br><br>
        </div>
        <!-- S and A details tab -->
        <div id="S-and-A" class="tabcontent">
            <h1>Status/Admin Information</h1>
            <form action='booking-details.php' method='post'>
                <input type='text' id='reservation-id' name='reservation-id'
                    style="margin-bottom: 10px;color: black;background-color: #eaf4fe; font-size:17px; border-top:black;border-left:black;border-right:black; "
                    placeholder="&nbsp &nbsp Enter reservation ID">
                <button class='button' type='submit' name='search-reservation-by-id'
                    value='Search by Reservation Id' style='padding: 5px 10px; font-size: 14px;'>
                    <span>Search</span>
                </button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th width="20%">Reservation ID</th>
                        <th width="20%">Car ID</th>
                        <th width="20%">Order Status</th>
                        <th width="20%">Edited by(Admin ID)</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "carrental");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM bookings";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td width='20%'>" . $row['RESERVATION_ID'] . "</td>";
                            echo "<td width='20%'>" . $row['CAR_ID'] . "</td>";
                            echo "<td width='20%'>" . $row['STATUS'] . "</td>";
                            echo "<td width='20%'>" . $row['ADMIN_ID'] . "</td>";
                            echo "<td width='20%'>";
                            echo "<form action='booking-details.php?id=$row[RESERVATION_ID]' method='post'>";
                            echo "<button class='button' type='submit' name='booking-details'>";
                            echo "<span>Check Details</span>";
                            echo "</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>

            <br><br>
        </div>
        <!-- PD information tab-->
        <div id="P-and-D" class="tabcontent">
            <h1>Pickup/Dropoff Information</h1>
            <form action='booking-details.php' method='post'>
                <input type='text' id='reservation-id' name='reservation-id'
                    style="margin-bottom: 10px;color: black;background-color: #eaf4fe; font-size:17px; border-top:black;border-left:black;border-right:black; "
                    placeholder="&nbsp &nbsp Enter reservation ID">
                <button class='button' type='submit' name='search-reservation-by-id'
                    value='Search by Reservation Id' style='padding: 5px 10px; font-size: 14px;'>
                    <span>Search</span>
                </button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th width="15%">Reservation ID</th>
                        <th width="15%">Car ID</th>
                        <th width="20%">Pick-up Date</th>
                        <th width="20%">Drop-off Date</th>
                        <th width="20%">Booking Date</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "carrental");
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM bookings";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td width='15%'>" . $row['RESERVATION_ID'] . "</td>";
                            echo "<td width='15%'>" . $row['CAR_ID'] . "</td>";
                            echo "<td width='20%'>" . $row['PICKUP_DATE'] . "</td>";
                            echo "<td width='20%'>" . $row['DROPOFF_DATE'] . "</td>";
                            echo "<td width='20%'>" . $row['BOOKING_DATE'] . "</td>";
                            echo "<td width='10%'>";
                            echo "<form action='booking-details.php?id=$row[RESERVATION_ID]' method='post'>";
                            echo "<button class='button' type='submit' name='booking-details'>";
                            echo "<span>Check Details</span>";
                            echo "</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>

            <br><br>
        </div>

        <!-- Javascript to toggle between tabs -->
        <script>
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(tabName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
    </div>
</body>

</html>