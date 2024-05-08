<?php
    ini_set('session.gc_maxlifetime', 3600); // set session timeout to 1 hour
    session_set_cookie_params(3600); // set cookie timeout to 1 hour
    session_start();

    if (isset($_POST['existing-customer-booking'])) {
        $_SESSION['car_id'] = $_POST['car-id2'];
        $_SESSION['trx_type'] = 0;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reservation for Existing Customer</title>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/pstylep.css">
    <link rel="stylesheet" href="css/buttons.css">

	<style>
        body {
            background-color: #eaf4fe;
        }
		.container {
			max-width: 600px;
			margin: 20px auto;
			padding: 20px;
			background-color: #fff;
            margin-bottom: 20px;
			border-radius: 10px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
		}
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		input[type=text] {
			padding: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
			margin-bottom: 10px;
			width: 100%;
		}
		button {
			background-color: #d40219;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 10px 20px;
			cursor: pointer;
			margin-bottom: 10px;
			width: 100%;
		}
		button:hover {
			background-color: #fff;
            color: #d40219;
            border: 1px solid #d40219;
		}
	</style>

    <script>
		function showPrompt(type) {
			document.getElementById('search-buttons').style.display = 'none';
			document.getElementById('search-prompt').style.display = 'block';
            document.getElementById('search-type').innerHTML = type;
            document.getElementById('search-method').value = type;
		}

        function showResult() {
			document.getElementById('search-prompt').style.display = 'none';
			document.getElementById('main-div').style.display = 'block';
		}

        function searchAgain() {
			document.getElementById("search-result").innerHTML = "";
            document.getElementById('main-div').style.display = 'none';
            document.getElementById('search-buttons').style.display = 'block';
		}
	</script>
</head>

<body>
	<div class="container">
		<div id="search-buttons">
			<button onclick="showPrompt('Identification Number')">Search by Identification Number</button>
			<button onclick="showPrompt('Contact Number')">Search by Contact Number</button>
		</div>
		<div id="search-prompt" style="display: none;">
			<form method="post">
				<p>Enter <span id="search-type"></span> to search:</p>
                <input type="hidden" name="search-method" id="search-method" value="" required>   
				<input type="text" name="search-input" id="search-input" required>
				<button type="submit" name="search" onclick="showResult()">Search</button>
			</form>
		</div>
        <!-- <div id="main-div" style="display: none;">
            <div id="search-icon"> <!-- button to re-search --
                <button type="button" onclick="searchAgain()">Search Again</button>
            </div> -->
            <div id="search-result">
                <?php
                    $conn = new mysqli("localhost", "root", "", "carrental");
                    if($conn->connect_error) {
                        die("Connection failed: ".$conn->connect_error);
                    }

                    if(isset($_POST['search'])) {
                        $search_method = $_POST['search-method'];
                        $search_input = $_POST['search-input'];

                        if(empty($search_method) || empty($search_method)) {
                            ;
                        }
                        else if($search_method == 'Identification Number') {
                            $sql = "SELECT * FROM customers where ID_NUM = '$search_input'";
                        }
                        else if($search_method == 'Contact Number') {
                            $sql = "SELECT * FROM customers where CONTACT_NUM = '$search_input'";
                        }
                        $result = $conn->query($sql);

                        if($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<h3><br>Customer Id: </h3>";
                                echo $row['CUSTOMER_ID'];
                                echo "<h3><br>First Name: </h3>";
                                echo $row['FIRST_NAME'];
                                echo "<h3><br>Last Name: </h3>";
                                echo $row['LAST_NAME'];
                                echo "<h3><br>Email: </h3>";
                                echo $row['EMAIL'];
                                echo "<h3><br>Identification Number: </h3>";
                                echo $row['ID_NUM'];
                                echo "<h3><br>Contact Number: </h3>";
                                echo $row['CONTACT_NUM'];
                                echo "<h3><br></h3>";
                                echo "<form method='post' action='order-confirmation2.php'>
                                        <input type='hidden' name='first-name' id='first-name' value='$row[FIRST_NAME]'>
                                        <input type='hidden' name='last-name' id='last-name' value='$row[LAST_NAME]'>
                                        <input type='hidden' name='email' id='email' value='$row[EMAIL]'>
                                        <input type='hidden' name='id-num' id='id-num' value='$row[ID_NUM]'>
                                        <input type='hidden' name='contact-num' id='contact-num' value='$row[CONTACT_NUM]'>
                                        <button class='button' type='submit' name='select-customer' value='select'>Select</button>
                                     </form>";
                                
                            }
                        }else {
                            echo "No results found.";
                        }
                    }
                    $conn->close();
                ?>
            </div>
        <!-- </div> -->
	</div>
</body>
</html>
