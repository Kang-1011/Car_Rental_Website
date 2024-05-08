<?php
ini_set('session.gc_maxlifetime', 3600); // set session timeout to 1 hour
session_set_cookie_params(3600); // set cookie timeout to 1 hour
session_start();

$conn = new mysqli("localhost", "root", "", "carrental");
if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

$admin_id = $_SESSION['admin_id'];
$reservation_id = $_GET['reservation_id'];
$pickup_date = $_GET['pickup_date'];
$dropoff_date = $_GET['dropoff_date'];

date_default_timezone_set('Asia/Kuala_Lumpur');
$current_date_time = date('Y-m-d H:i:s');

$sql = "SELECT * FROM bookings where RESERVATION_ID = '$reservation_id'";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $old_pickup_date = $row['PICKUP_DATE'];
        $old_dropoff_date = $row['DROPOFF_DATE'];
        $old_order_total = $row['ORDER_TOTAL'];
        $car_id = $row['CAR_ID'];
    }
}else {
    echo "0 results";
}

$sql3 = "SELECT PRICE FROM cars WHERE CAR_ID = $car_id";
$result3 = $conn->query($sql3);
if($result3->num_rows > 0) {
    while($row3 = $result3->fetch_assoc()) {
        $car_price = $row3['PRICE'];
    }
}else {
    echo "0 results";
}

$dateA = DateTime::createFromFormat('Y-m-d', $old_pickup_date);
$dateB = DateTime::createFromFormat('Y-m-d', $old_dropoff_date);
$old_date_diff = $dateA->diff($dateB);
$old_duration = $old_date_diff->days;

$date1 = DateTime::createFromFormat('Y-m-d', $pickup_date);
$date2 = DateTime::createFromFormat('Y-m-d', $dropoff_date);
$date_diff = $date1->diff($date2);
$duration = $date_diff->days;

$order_total = $duration * $car_price;

$sql2 = "UPDATE bookings SET PICKUP_DATE = '$pickup_date', DROPOFF_DATE = '$dropoff_date', ORDER_TOTAL = '$order_total', LAST_EDITED = '$current_date_time', ADMIN_ID = '$admin_id' WHERE RESERVATION_ID = '$reservation_id'";
if($conn->query($sql2) === True) {
    echo '<script>alert("Reservation updated")</script>';
    echo '<script>window.location.replace("updated-invoice.php?id='.$reservation_id.'&date1='.$old_pickup_date.'&date2='.$old_dropoff_date.'&duration1='.$old_duration.'&duration2='.$duration.'&total='.$old_order_total.'");</script>';
} else{
    echo '<script>alert("Error updating reservation")</script>';
}
?>