<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Car </title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
    <script src="popup.js"></script>
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
            <li><a href="adminlogin.php">Log Out</a></li>
        </ul>
    </div>
    <div id="logo">
        <a href="homepage.php"><img src="Images/logo.png" alt=""></a>
    </div>
    <br><br><br><br><br><br><br>
    <div>
        <div class="tab">
            <button id="open-popup-button" onclick="openPopUp()">+ Add a New Car</button>
            <button class="button" onclick="openTab(event, 'AllCars')">All Cars</button>
            <button class="button" onclick="openTab(event, 'Luxurious')">Luxurious Cars</button>
            <button class="button" onclick="openTab(event, 'Sports')">Sports Cars</button>
            <button class="button" onclick="openTab(event, 'Classic')">Classic Cars</button>
        </div>
    </div>
    <br>
    <div id="popup-container">
        <div class="popup">
            <h2>Add a Car</h2>
            <form action="addcar.php" method="post">
                <label for="carname">Car name:</label>
                <input type="text" name="carname" id="carname" required>
                <label for="registration-number">Registration number:</label>
                <input type="text" name="registration-number" id="registration-number" required>
                <label for="cartype">Car type:</label>
                <select name="cartype" id="cartype">
                    <option value="" disabled selected hidden>Please select</option>
                    <option value="Luxurious Car">Luxurious Car</option>
                    <option value="Sports Car">Sports Car</option>
                    <option value="Classics Car">Classics Car</option>
                </select>
                <label for="seat-capacity">Seat capacity:</label>
                <input type="number" name="seat-capacity" id="seat-capacity" required>
                <label for="price">Price(per Day):</label>
                <input type="number" name="price" id="price" required>
                <input type="submit" name="addcar" value="Save and Publish">
            </form>
            <button id="close-popup-button" onclick="closePopUp()">Close</button>
        </div>
    </div>
    <div id="AllCars" class="tabcontent">

        <?php
        $conn = new mysqli("localhost", "root", "", "carrental");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cars";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                        <thead>
                            <tr>
                                <th>Car ID</th>
                                <th>Car Name</th>
                                <th>Registration Number</th>
                                <th>Car Type</th>
                                <th>Seat Capacity</th>
                                <th>Price(per Day)</th>
                                <th>Status</th>
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
                echo $row['REGISTRATION_NUM'];
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
                echo $row['STATUS'];
                echo "</td>";

                echo "<td>";
                if ($row['STATUS'] == 'Active') {
                    echo "<form method='post'>
                                <input type='hidden' id='car-id' name='car-id' value='$row[CAR_ID]' required>
                                <button class='button' type='submit' name='remove-car'>
                                    <span>Disable</span>
                                </button>
                            </form>";
                }
                if ($row['STATUS'] == 'Inactive') {
                    echo "<form method='post'>
                                <input type='hidden' id='car-id' name='car-id' value='$row[CAR_ID]' required>
                                <button class='button' type='submit' name='enable-car'>
                                    <span>Enable</span>
                                </button>
                            </form>";
                }
                echo "</td>";

                echo "</tr>";
            }

            echo "</tbody>
                    </table>";
        } else {
            echo "0 results";
        }

        if (isset($_POST['remove-car'])) {
            echo "<script>";
            echo "if(confirm('Are you sure you want to disable this car?')){";
            echo '    window.location.href = "removecar.php?carid=' . $_POST['car-id'] . '";';
            echo "}";
            echo "</script>";
        }
        if (isset($_POST['enable-car'])) {
            echo "<script>";
            echo "if(confirm('Are you sure you want to add this car?')){";
            echo '    window.location.href = "enablecar.php?carid=' . $_POST['car-id'] . '";';
            echo "}";
            echo "</script>";
        }

        $conn->close()
            ?>
        <br><br>
    </div>
    <div id="Sports" class="tabcontent">

        <?php
        $conn = new mysqli("localhost", "root", "", "carrental");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cars";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Name</th>
                        <th>Registration Number</th>
                        <th>Car Type</th>
                        <th>Seat Capacity</th>
                        <th>Price(per Day)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = $result->fetch_assoc()) {

                if ($row['CAR_TYPE'] == "Sports Car") {
                    echo "<tr>";

                    echo "<td>";
                    echo $row['CAR_ID'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['CAR_NAME'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['REGISTRATION_NUM'];
                    echo "</td>";
                    echo "<td>";
                    "<td>";
                    echo $row['CAR_TYPE'];
                    echo "</td>";

                    echo "<td>";
                    echo $row['SEAT_CAPACITY'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['PRICE'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['STATUS'];
                    echo "</td>";

                    echo "<td>";
                    if ($row['STATUS'] == 'Active') {
                        echo "<form method='post'>
                                <input type='hidden' id='car-id' name='car-id' value='$row[CAR_ID]' required>
                                <button class='button' type='submit' name='remove-car'>
                                    <span>Disable</span>
                                </button>
                            </form>";
                    }
                    if ($row['STATUS'] == 'Inactive') {
                        echo "<form method='post'>
                                <input type='hidden' id='car-id' name='car-id' value='$row[CAR_ID]' required>
                                <button class='button' type='submit' name='enable-car'>
                                    <span>Enable</span>
                                </button>
                            </form>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            }

            echo "</tbody>
            </table>";
        } else {
            echo "0 results";
        }

        if (isset($_POST['remove-car'])) {
            echo "<script>";
            echo "if(confirm('Are you sure you want to disable this car?')){";
            echo '    window.location.href = "removecar.php?carid=' . $_POST['car-id'] . '";';
            echo "}";
            echo "</script>";
        }
        if (isset($_POST['enable-car'])) {
            echo "<script>";
            echo "if(confirm('Are you sure you want to add this car?')){";
            echo '    window.location.href = "enablecar.php?carid=' . $_POST['car-id'] . '";';
            echo "}";
            echo "</script>";
        }



        $conn->close()
            ?>
        <br><br>
    </div>
    <div id="Luxurious" class="tabcontent">

        <?php
        $conn = new mysqli("localhost", "root", "", "carrental");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cars";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Name</th>
                        <th>Registration Number</th>
                        <th>Car Type</th>
                        <th>Seat Capacity</th>
                        <th>Price(per Day)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = $result->fetch_assoc()) {

                if ($row['CAR_TYPE'] == "Luxurious Car") {
                    echo "<tr>";

                    echo "<td>";
                    echo $row['CAR_ID'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['CAR_NAME'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['REGISTRATION_NUM'];
                    echo "</td>";
                    echo "<td>";
                    "<td>";
                    echo $row['CAR_TYPE'];
                    echo "</td>";

                    echo "<td>";
                    echo $row['SEAT_CAPACITY'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['PRICE'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['STATUS'];
                    echo "</td>";

                    echo "<td>";
                    if ($row['STATUS'] == 'Active') {
                        echo "<form method='post'>
                                <input type='hidden' id='car-id' name='car-id' value='$row[CAR_ID]' required>
                                <button class='button' type='submit' name='remove-car'>
                                    <span>Disable</span>
                                </button>
                            </form>";
                    }
                    if ($row['STATUS'] == 'Inactive') {
                        echo "<form method='post'>
                                <input type='hidden' id='car-id' name='car-id' value='$row[CAR_ID]' required>
                                <button class='button' type='submit' name='enable-car'>
                                    <span>Enable</span>
                                </button>
                            </form>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            }

            echo "</tbody>
            </table>";
        } else {
            echo "0 results";
        }

        if (isset($_POST['remove-car'])) {
            echo "<script>";
            echo "if(confirm('Are you sure you want to disable this car?')){";
            echo '    window.location.href = "removecar.php?carid=' . $_POST['car-id'] . '";';
            echo "}";
            echo "</script>";
        }
        if (isset($_POST['enable-car'])) {
            echo "<script>";
            echo "if(confirm('Are you sure you want to add this car?')){";
            echo '    window.location.href = "enablecar.php?carid=' . $_POST['car-id'] . '";';
            echo "}";
            echo "</script>";
        }



        $conn->close()
            ?><br><br>
    </div>
    <div id="Classic" class="tabcontent">

        <?php
        $conn = new mysqli("localhost", "root", "", "carrental");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM cars";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Name</th>
                        <th>Registration Number</th>
                        <th>Car Type</th>
                        <th>Seat Capacity</th>
                        <th>Price(per Day)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";

            while ($row = $result->fetch_assoc()) {

                if ($row['CAR_TYPE'] == "Classics Car") {
                    echo "<tr>";

                    echo "<td>";
                    echo $row['CAR_ID'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['CAR_NAME'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['REGISTRATION_NUM'];
                    echo "</td>";
                    echo "<td>";
                    "<td>";
                    echo $row['CAR_TYPE'];
                    echo "</td>";

                    echo "<td>";
                    echo $row['SEAT_CAPACITY'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['PRICE'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['STATUS'];
                    echo "</td>";

                    echo "<td>";
                    if ($row['STATUS'] == 'Active') {
                        echo "<form method='post'>
                                <input type='hidden' id='car-id' name='car-id' value='$row[CAR_ID]' required>
                                <button class='button' type='submit' name='remove-car'>
                                    <span>Disable</span>
                                </button>
                            </form>";
                    }
                    if ($row['STATUS'] == 'Inactive') {
                        echo "<form method='post'>
                                <input type='hidden' id='car-id' name='car-id' value='$row[CAR_ID]' required>
                                <button class='button' type='submit' name='enable-car'>
                                    <span>Enable</span>
                                </button>
                            </form>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            }

            echo "</tbody>
            </table>";
        } else {
            echo "0 results";
        }

        if (isset($_POST['remove-car'])) {
            echo "<script>";
            echo "if(confirm('Are you sure you want to disable this car?')){";
            echo '    window.location.href = "removecar.php?carid=' . $_POST['car-id'] . '";';
            echo "}";
            echo "</script>";
        }
        if (isset($_POST['enable-car'])) {
            echo "<script>";
            echo "if(confirm('Are you sure you want to add this car?')){";
            echo '    window.location.href = "enablecar.php?carid=' . $_POST['car-id'] . '";';
            echo "}";
            echo "</script>";
        }



        $conn->close()
            ?><br><br>
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
<html>