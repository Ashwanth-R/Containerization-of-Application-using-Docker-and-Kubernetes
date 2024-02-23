<?php
$uname = $_COOKIE['USER'];
$name = $_POST['NAME'];
$age = $_POST['AGE'];
$gender = $_POST['GENDER'];
$phone = $_POST['PHONE'];
$door = $_POST['DOOR'];
$street = $_POST['STREET'];
$area = $_POST['AREA'];
$city = $_POST['CITY'];
$state = $_POST['STATE'];

$conn = new mysqli("mysqldb", "root", "mypassword", "tickets");

if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$query = "INSERT INTO PROFILE VALUES (?,?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssississss", $uname, $name, $age, $gender, $phone, $door, $street, $area, $city, $state);
$stmt->execute();
$stmt->close();

// echo "<h1>REGISTRATION</h1>";
// echo "<p style='text-align:center;>Your data has been entered successfully. Please login to our website to view or update it</p>";
// echo "<p style='text-align:center;'><a href='login.php'><input type='button' class='BUTTON' value='Login'></a></p>";
?>
<!DOCTYPE html>
<html>

<head>
    <title>CONTACTS</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>
    <h1>REGISTRATION</h1>
    <p style='text-align:center;'>Your data has been entered successfully. Please login to our website to view or update it</p>
    <p style=' text-align:center;'><a href='login.php'><input type='button' class='BUTTON' value='Login'></a></p>
</body>

</html>