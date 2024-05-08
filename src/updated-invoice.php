<?php
ini_set('session.gc_maxlifetime', 3600); // set session timeout to 1 hour
session_set_cookie_params(3600); // set cookie timeout to 1 hour
session_start();

$conn = new mysqli("localhost", "root", "", "carrental");
if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

$reservation_id = $_GET['id'];
$old_pickup_date = $_GET['date1'];
$old_dropoff_date = $_GET['date2'];
$old_duration = $_GET['duration1'];
$duration = $_GET['duration2'];
$old_order_total = $_GET['total'];

date_default_timezone_set('Asia/Kuala_Lumpur');
$current_date = date('Y-m-d');

$admin_id = $_SESSION['admin_id'];
$sql5 = "SELECT FIRST_NAME, LAST_NAME FROM admin WHERE ADMIN_ID = $admin_id";
$result5 = $conn->query($sql5);
if($result5->num_rows > 0) {
    while($row5 = $result5->fetch_assoc()) {
        $admin_first_name = $row5['FIRST_NAME'];
        $admin_last_name = $row5['LAST_NAME'];
    }
}else {
    echo "0 results";
}

$sql1 = "SELECT * FROM bookings WHERE RESERVATION_ID = '$reservation_id'";
$result1 = $conn->query($sql1);
if($result1->num_rows > 0) {
    while($row1 = $result1->fetch_assoc()) {
        $customer_id = $row1['CUSTOMER_ID'];
        $order_total = $row1['ORDER_TOTAL'];
        $pickup_date = $row1['PICKUP_DATE'];
        $dropoff_date = $row1['DROPOFF_DATE'];
        $order_status = $row1['STATUS'];
        $car_id = $row1['CAR_ID'];
    }
}else {
    echo "0 results";
}

$sql2 = "SELECT * FROM customers WHERE CUSTOMER_ID = '$customer_id'";
$result2 = $conn->query($sql2);
if($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        $firstname = $row2['FIRST_NAME'];
        $lastname = $row2['LAST_NAME'];
        $hp = $row2['CONTACT_NUM'];
        $email = $row2['EMAIL'];
    }
}else {
    echo "0 results";
}

$sql3 = "SELECT * FROM cars WHERE CAR_ID = $car_id";
$result3 = $conn->query($sql3);
if($result3->num_rows > 0) {
    while($row3 = $result3->fetch_assoc()) {
        $car_price = $row3['PRICE'];
        $car_name = $row3['CAR_NAME'];
    }
}else {
    echo "0 results";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Official Invoice</title>
    <link rel="stylesheet" href="invoice.css">
    <script src="printpage.js"></script>
</head>

<body>
    <div id="invoice-for-customer">
        <header>
            <!-- <div class="logo">
                <img src="your-logo.png" alt="Company Logo">
            </div> -->
            <div class="company-info">
                <div class="company-info-left">
                    <h2>UNM Car Rental<span style="font-size: 14px;">(Company Reg No.: 139419-A)</span></h2>
                    <p>No.1A Jalan Broga, Nottingham Town</p> 
                    <p>43500 Semenyih, Selangor</p>
                    <p>Phone: (060) 456-7890&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax: (060) 456-7890</p>
                    <p>Email: info@unm.com</p>
                </div>
                <div class="company-info-right">
                    <h2>INVOICE</h2>
                    <div class="company-info-right-left">
                        <p>Tax Id No.:</p>
                        <p>Invoice No.:</p>
                        <p>Invoice Date:</p>
                        <p>Issued By:</p>
                    </div>
                    <div class="company-info-right-right">
                        <p>P11-001234-5688</p>
                        <p>UNM1390<?php echo $reservation_id?>(R)</p>
                        <p><?php echo $current_date?></p>
                        <p><?php echo $admin_first_name . " " . $admin_last_name?></p>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div id="big-container">
                <div class="customer-details">
                    <h3>Invoice To:</h3>
                    <p><?php echo $firstname . " " . $lastname?></p>
                    <p>Mobile:&nbsp;&nbsp;<?php echo $hp?></p>
                    <p>Email :&nbsp;&nbsp;<?php echo $email?></p>
                </div>
                <div class="reservation-details">
                    <p style="font-size: 20px">Reservation Number: &nbsp;&nbsp;<?php echo $reservation_id?></p>
                </div>
            </div>
            <div class="invoice-details">
                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Duration(Day)</th>
                            <th>Price(per Day)</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php
                                    if($order_status == 'Confirmed') {
                                        echo "Reservation update for reservation id: " . $reservation_id;
                                        echo "<br>";
                                        echo "<p>Car Rental for " . $car_name ."</p>";
                                        echo "<p style='font: caption;'><small>Pick-up Date &nbsp;: <del>" . $old_pickup_date . "</del> &nbsp;" . $pickup_date; 
                                        echo "<br>";
                                        echo "Drop-off Date : <del>" . $old_dropoff_date . "</del> &nbsp;" . $dropoff_date . "</small></p>";
                                    }
                                    else if($order_status == 'Cancelled') {
                                        echo "Reservation cancelled for reservation id: " . $reservation_id;
                                        echo "<br>";
                                        echo "<p>Car Rental for " . $car_name ."</p>";
                                        echo "<p style='font: caption;'><small>Pick-up Date &nbsp;: <del>" . $old_pickup_date . "</del>"; 
                                        echo "<br>";
                                        echo "Drop-off Date : <del>" . $old_dropoff_date . "</del></small></p>";
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if(($order_status == 'Confirmed') && ($old_duration != $duration)) {
                                        echo "<del>" . $old_duration . "</del> &nbsp;" . $duration;
                                    }
                                    else if(($order_status == 'Confirmed') && ($old_duration == $duration)) {
                                        echo $duration;
                                    }
                                    else if($order_status == 'Cancelled') {
                                        echo "<del>" . $old_duration . "</del>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $car_price?></td>
                            <td>
                                <?php
                                    if(($order_status == 'Confirmed') && ($old_order_total != $order_total)) {
                                        echo "<del>" . $old_order_total . "</del> &nbsp;" . $order_total;
                                    }
                                    else if(($order_status == 'Confirmed') && ($old_order_total == $order_total)) {
                                        echo $old_order_total;
                                    }
                                    else if($order_status == 'Cancelled') {
                                        echo "<del>" . $old_order_total . "</del>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" rowspan="6">
                                <div id="td-span">
                                    <p style="text-align: left; font-weight: normal; margin: 0px">Note:</p>
                                    <textarea id="note" name="note"></textarea>
                                </div>
                            </td>
                            <td>Previous Balance</td>
                            <td><?php echo $old_order_total?></td>
                        </tr>
                        <tr>
                            <td>Current Total</td>
                            <td><?php echo $order_total?></td>
                        <tr>
                        <tr>
                            <td>Additional Charges</td>
                            <td>
                                <?php
                                    if($order_status == 'Confirmed') {
                                        echo 0;
                                    }
                                    else if($order_status == 'Cancelled') {
                                        echo $old_order_total * 0.025;
                                    }
                                ?>
                            </td>
                        <tr>
                        <tr>
                            <td>Total(RM)</td>
                            <td id="total">
                                <?php
                                    if($order_status == 'Confirmed') {
                                        echo ($order_total - $old_order_total);
                                    }
                                    else if($order_status == 'Cancelled') {
                                        echo $order_total - ($old_order_total * 0.025);
                                    }
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br><br>
            <div class="signature-container">
                <div class="signature-box">
                    <label for="customer-signature">Customer Signature</label>
                    <canvas id="customer-signature"></canvas>
                </div>
                <div class="signature-box">
                    <label for="company-signature">Company Stamp</label>
                    <canvas id="company-signature"></canvas>
                </div>
            </div>
            <div id="tnc">
                <p><small>* Any requests to change/cancel this reservation must be made at least one(1) day in advance of the scheduled pick-up date. We will make every effort to accommodate date change requests, subject to availability.</small></p>
                <p><small>* By signing this invoice, you acknowledge that you have read and agree to our terms and privacy policy.</small></p>
            </div>
        </main>
    </div>
    <div id="buttons">
        <a href="homepage.php"><button>Home</button></a>
        <button onclick="printPageArea('invoice-for-customer')">Print</a>
    </div>
</body>
</html>

<?php
    $conn->close();
?> 