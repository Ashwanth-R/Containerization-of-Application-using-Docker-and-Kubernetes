<?php
session_start();
if (empty($_COOKIE['userName'])) {
    sleep(2);
    setcookie('info', 'You cannot confirm bookings without login.');
    header("Location: login.php");
    exit(1);
}
$conn = new mysqli("mysqldb", "root", "mypassword", "tickets");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$cost = 1000;
$total = 0;
$user = $_COOKIE['USERNAME'];
$from_loc = $_COOKIE['fromloc'];
$to_loc = $_COOKIE['toloc'];
$phone = $_COOKIE['phone'];
$pref = $_COOKIE['preference'];
$seats = $_COOKIE['seats'];
$date = $_COOKIE['date'];

$result = $conn->query("SELECT MAX(DISTINCT(BOOKID)) AS BOOKID FROM DETAILED_BOOKINGS WHERE UNAME = '$user'");
if (mysqli_num_rows($result) == 0)
    $bookid = 1;
else {
    $query = $result->fetch_assoc();
    $bookid = $query['BOOKID'] + 1;
}
$stmt = $conn->prepare("INSERT INTO BOOKINGS VALUES (?,?,?,?,?,?,?,?);");
$stmt->bind_param("isssssis", $bookid, $user, $from_loc, $to_loc, $phone, $pref, $seats, $date);
$stmt->execute();

$query = "SELECT SEATS FROM AVAILS WHERE DEP_DATE = '" . $_COOKIE['date'] . "';";
$result = $conn->query($query);
$remaining = $result->fetch_assoc();

$remaining['SEATS'] -= $seats;
$SEATS = $remaining['SEATS'];

$query = "UPDATE AVAILS SET SEATS = ? WHERE DEP_DATE = ? ;";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $SEATS, $date);
$stmt->execute();

$stmt->close();

for ($i = 1; $i <= $seats; $i++) {
    $names = $_POST['name' . $i];
    $ages = $_POST['age' . $i];
    $genders = $_POST['gender' . $i];

    if ($ages <= 5)
        $rate = $cost * 0;
    else if ($ages > 5 && $ages <= 12)
        $rate = $cost * 0.5;
    else if ($ages > 12 && $ages <= 59)
        $rate = $cost;
    else
        $rate = $cost * 0.6;

    $total += $rate;
    $stmt = $conn->prepare("INSERT INTO DETAILED_BOOKINGS VALUES (?,?,?,?,?,?);");
    $stmt->bind_param("issisd", $bookid, $user, $names, $ages, $genders, $rate);
    $stmt->execute();
}
echo '<span style="color: aqua; text-align: center;">TRAIN RESERVATION</span>';
echo "<p style='text-align:center;'>Booking has been done successfully.<br>The total cost is $total.<br>";
echo "Pay it at our nearest railway station to claim your ticket.</p>";

$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$random_letters = substr(str_shuffle($letters), 0, 10);
$random_numbers = rand(1000000000, 9999999999);
$random_string = $random_letters . $random_numbers;

echo "<p style='text-align:center;'>Kindly note this referral code: '$random_string' to get your ticket.</p>";


echo "<p style='text-align:center;'>Go to home page by clicking 'HOME' button <br><br> <a href='home.php' style='text-align:center;'><input type='button' value='HOME' class='BUTTON'></a>";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Train Ticket Reservation System</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>