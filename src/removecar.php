<?php
    $conn = new mysqli("localhost", "root", "", "carrental");
    if($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    $car_id = $_GET['carid'];
    $sql = "UPDATE cars SET STATUS='Inactive' WHERE CAR_ID = $car_id";

    if($conn->query($sql) === True) {
        echo "<script>alert('Car status set /'Inactive/' successfully')</script>";
        echo '<script>window.location.href=document.referrer</script>';
    } else{
        echo '<script>alert("Error")</script>';
    }

    $conn->close();
?>