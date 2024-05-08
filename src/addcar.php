<?php
$conn = new mysqli("localhost", "root", "", "carrental");
if($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

if (isset($_POST['addcar'])) {
    $carname = $_POST['carname'];
    $registration_number = $_POST['registration-number'];
    $cartype = $_POST['cartype'];
    $seat_capacity = $_POST['seat-capacity'];
    $price = $_POST['price'];

    if(empty($carname) || empty($cartype) || empty($price)) {
        echo "Please fill in all fields";
    }
    else {
        $sql = "INSERT INTO cars(CAR_NAME, REGISTRATION_NUM, CAR_TYPE, SEAT_CAPACITY, PRICE) VALUES ('$carname', '$registration_number', '$cartype', '$seat_capacity', '$price')";

        if($conn->query($sql) === True) {
            echo "<script>
            window.alert('New car added');
            window.location.href = document.referrer;
            </script>";
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>