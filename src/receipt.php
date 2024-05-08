<?php
ini_set('session.gc_maxlifetime', 3600); // set session timeout to 1 hour
session_set_cookie_params(3600); // set cookie timeout to 1 hour
session_start();

$conn = new mysqli("localhost", "root", "", "carrental");
if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

if (isset($_POST['book'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $ic_num = $_POST['id-num']; 
    $hp = $_POST['contact-num'];
    $email = $_POST['email'];
    $payment = $_POST['payment-method'];

    $admin_id = $_SESSION['admin_id'];
    $car_id = $_SESSION['car_id'];
    $pickup_date = $_SESSION['pickup_date'];
    $dropoff_date = $_SESSION['dropoff_date'];
    $trx_type = $_SESSION['trx_type'];

    if($trx_type == 1) {
        $sql1 = "INSERT INTO customers(FIRST_NAME, LAST_NAME, EMAIL, ID_NUM, CONTACT_NUM, ADMIN_ID) VALUES ('$firstname', '$lastname', '$email', '$ic_num', '$hp', '$admin_id')";
        if($conn->query($sql1) === True) {
            ;
        }else{
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
    }

    $sql2 = "SELECT CUSTOMER_ID FROM customers WHERE ID_NUM = '$ic_num'";
    $result2 = $conn->query($sql2);
    if($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
            $customer_id = $row2['CUSTOMER_ID'];
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

    $order_total = $_SESSION['dateDiff'] * $car_price;

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $current_date = date('Y-m-d');
    $current_date_time = date('Y-m-d H:i:s');

    $sql4 = "INSERT INTO bookings(CAR_ID, PICKUP_DATE, DROPOFF_DATE, CUSTOMER_ID, CUSTOMER_HP, ORDER_TOTAL, ADMIN_ID, BOOKING_DATE, LAST_EDITED) VALUES ('$car_id', '$pickup_date', '$dropoff_date', '$customer_id', '$hp', '$order_total', '$admin_id', '$current_date', '$current_date_time')";
    if($conn->query($sql4) === True) {
        $last_id = $conn->insert_id;
    }else{
        echo "Error: " . $sql4 . "<br>" . $conn->error;
    }

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
                        <p>UNM1390<?php echo $last_id?></p>
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
                    <p style="font-size: 20px">Reservation Number: &nbsp;&nbsp;<?php echo $last_id?></p>
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
                                    echo "Car Rental for " . $car_name;
                                    echo "<br>";
                                    echo "<p style='font: caption;'><small>Pick-up Date  : ". $pickup_date; 
                                    echo "<br>";
                                    echo "Drop-off Date : " . $dropoff_date . "</small></p>";
                                ?>
                            </td>
                            <td><?php echo $_SESSION['dateDiff']?></td>
                            <td><?php echo $car_price?></td>
                            <td><?php echo $order_total?></td>
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
                            <td colspan="2" rowspan="5">
                                <div id="td-span">
                                    <p style="text-align: left; font-weight: normal; margin: 0px">Note:</p>
                                    <textarea id="note" name="note"></textarea>
                                </div>
                            </td>
                            <td>Subtotal</td>
                            <td><?php echo $order_total?></td>
                        </tr>
                        <tr>
                            <td>Additional Charges</td>
                            <td>0</td>
                        <tr>
                        <tr>
                            <td>Total(RM)</td>
                            <td id="total"><?php echo $order_total?></td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td><?php echo $payment?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br><br><br>
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