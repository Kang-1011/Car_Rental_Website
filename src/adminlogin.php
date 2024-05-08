<?php
ini_set('session.gc_maxlifetime', 10800); // set session timeout to 3 hours
session_set_cookie_params(10800); // set cookie timeout to 3 hours
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <script src="popup.js"></script>
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="css/styleex.css">
    <link rel="stylesheet" href="css/buttons.css">

    <style>
        body {
            overflow: hidden;
        }

        #login-container {
            display: flex;
            justify-content: center;
            align-items: top;
        }

        .input-fields {
            margin-bottom: 10px;
            background-color: #eaf4fe;
            border-top: black;
            border-left: black;
            border-right: black;
        }

        #button-container {
            display: flex;
            justify-content: center;
            align-items: top;
        }

        .button {
            margin: 90px;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="navbar">
            <div id="logo">
                <img src="Images/logo.png" alt="">
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <div id="login-container">
            <h1 style="color: #d40219;size:200px;margin-right:50px;">Admin Login</h1>
            <form method="post">
                <div>
                    <!-- <div class="labels">
                    <label for="username" id="username-label">Username:</label>
                </div> -->
                    <div>
                        <input type="text" id="login-username" name="login-username" class="input-fields"
                            style="color: black;" placeholder="&nbsp Username" required>
                        <br>
                    </div>
                </div>
                <div>
                    <!-- <div class="labels">
                    <label for="password" id="password-label">Password:</label>
                </div> -->
                    <div>
                        <input type="password" id="login-password" name="login-password" class="input-fields"
                            style="color: #d40219;" placeholder="&nbsp Password" required>
                        <br>
                    </div>
                </div>
        </div>
        <div>
            <div id="button-container">
                <button type="submit" class='button' id="login" name="login">Login</button>
                <button id="open-popup-button" class='button' onclick="openPopUp()">Create new account</button>
            </div>
            </form>
        </div>

        <div id="popup-container">
            <div class="popup">
                <h2>Sign Up</h2>
                <form method="post">
                    <label for="firstname">First name:</label>
                    <input type="text" name="firstname" id="firstname" required>
                    <label for="lastname">Last name:</label>
                    <input type="text" name="lastname" id="lastname" required>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    <input type="submit" name="signup" value="Sign Up">
                </form>
                <button id="close-popup-button" onclick="closePopUp()">Close</button>
            </div>
        </div>
    </div>

<?php
$conn = new mysqli("localhost", "root", "", "carrental");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    if (empty($username) || empty($password)) {
        ;
    } else {
        $sql = "SELECT * FROM admin where LOGIN_USERNAME = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($password === $row['LOGIN_PASSWORD']) {
                    $_SESSION['admin_id'] = $row['ADMIN_ID'];
                    echo "<script>window.location.href='homepage.php'</script>";
                } else {
                    echo "<script>window.alert('Incorrect password')</script>";
                }
            }
        } else {
            echo "<script>window.alert('Invalid username')</script>";
        }
    }
}

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($firstname) || empty($lastname) || empty($username) || empty($password)) {
        ;
    } else {
        $sql1 = "SELECT LOGIN_USERNAME FROM admin";
        $result1 = $conn->query($sql1);
        $sql2 = "INSERT INTO admin(FIRST_NAME, LAST_NAME, LOGIN_USERNAME, LOGIN_PASSWORD) VALUES ('$firstname', '$lastname', '$username', '$password')";

        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                if ($username === $row1['LOGIN_USERNAME']) {
                    echo "<script>window.alert('Username taken. Please enter a different username to sign up.')</script>";
                    exit();
                }
            }
            if ($conn->query($sql2) === True) {
                echo "<script>window.alert('New admin account created successfully')</script>";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        } else {
            if ($conn->query($sql2) === True) {
                echo "<script>window.alert('New admin account created successfully')</script>";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        }
    }
}
$conn->close();
?>

</body>

</html>