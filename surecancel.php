<?php
ob_start();
session_start();
if (empty($_COOKIE['userName'])) {
    sleep(2);
    setcookie('info', 'You cannot see your bookings without login.');
    header("Location: login.php");
    exit(1);
}

$conn = new mysqli("mysqldb", "root", "mypassword", "tickets");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$USER = $_COOKIE['USERNAME'];

$details = $conn->query("SELECT MAX(DISTINCT(BOOKID)) AS BOOKID FROM DETAILED_BOOKINGS WHERE UNAME = '$USER';");
$row = $details->fetch_assoc();
echo "<p>Select the booking no to be canceled (if you are not sure, then see your bookings via <a href='bookings.php'>Click Here</a>).</p>";
echo "<p class='warning'>After cancelation, this process cannot be undone.</p>";

echo '<form action="cancel.php" method="post" ALIGN="center">';
echo '<p>Select the booking no given below</p>';
echo '<select name="canbook" style="width:250px;font-size:30px;">';
for ($i = 1; $i <= $row['BOOKID']; $i++)
    echo '<option value="' . $i . '">Booking no ' . $i . '</option>';
echo "</select>";
echo '<p><input type="submit" value="CANCEL IT" class="BUTTON"></p></form>';
setcookie('bookid', $row['BOOKID']);
ob_end_flush();
?>
<!DOCTYPE html>
<html>
<head>
    <title>List of Bookings</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>
<body>
    <h1>CANCEL BOOKING</h1>
</body>