<?php
session_start();
if (empty($_COOKIE['userName'])) {
    sleep(2);
    setcookie('info', 'Changes to a Profile cannot be done without login.');
    header("Location: login.php");
    exit(1);
}

$uname = $_COOKIE['USERNAME'];
$conn = new mysqli("mysql_db", "root", "mypassword", "tickets");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$query = "SELECT * FROM PROFILE WHERE UNAME = '$uname';";
$result = $conn->query($query);

$row = $result->fetch_assoc();
$user = $row['UNAME'];
$name = $row['NAME'];
$age = $row['AGE'];
$gender = $row['GENDER'];
$phone = $row['PH_NO'];
$door = $row['DOOR_NO'];
$street = $row['STREET'];
$area = $row['AREA'];
$city = $row['CITY'];
$state = $row['STATE'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>
    <h1>EDIT YOUR PROFILE</h1>
    <br><br>
    <div id='clock' align='center' class='CLOCK'></div>
    <br><br>
    <form action="update.php" method="post">
        <table align="center">
            <tr>
                <td>
                    <span>Enter your name</span><br>
                    <input type="text" class="Inputs" required name="NAME" width="150px" value="' . $name . '">
                </td>
                <td>
                    <span>Enter your Age</span><br>
                    <input type="number" class="Inputs" required min="10" max="150" name="AGE" width="150px"
                        value="' . $age . '">
                </td>
                <td>
                    <span>Enter your Gender</span><br>
                    if ($gender == 'M')
                    <select name="GENDER" width="150px">
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                    else if ($gender == 'F')
                    <select name="GENDER" width="150px">
                        <option value="F">Female</option>
                        <option value="M">Male</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <span>Enter your Phone Number</span><br>
                    <input type="text" class="Inputs" required name="PHONE" width="150px" value="' . $phone . '">
                </td>
                <td>
                    <span>Enter your Door Number</span><br>
                    <input type="text" class="Inputs" required name="DOOR" width="150px" value="' . $door . '">
                </td>
                <td>
                    <span>Enter your Street</span><br>
                    <input type="text" class="Inputs" required name="STREET" width="150px" value="' . $street . '">
                </td>
            </tr>
            <tr>
                <td>
                    <span>Enter your Area</span><br>
                    <input type="text" class="Inputs" required name="AREA" width="150px" value="' . $area . '">
                </td>
                <td>
                    <span>Enter your City</span><br>
                    <input type="text" class="Inputs" required name="CITY" width="150px" value="' . $city . '">
                </td>
                <td>
                    <span>Enter your State</span><br>
                    <input type="text" class="Inputs" required name="STATE" width="150px" value="' . $state . '">
                </td>
            </tr>
        </table>
        <p align="center"><input type="submit" value="Update" class="BUTTON"></p>
        <p align="center"><a href="home.php"><input type="button" value="Abort" class="BUTTON"></a></p>
</body>
<script src="TIME.js"></script>

</html>