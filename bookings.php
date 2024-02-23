<?php
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
$user = $_COOKIE['USERNAME'];
$details = $conn->query("SELECT * FROM BOOKINGS WHERE USER_NAME = '$user';");
if (mysqli_num_rows($details) <= 0)
    echo "<p>
                        Looks like you haven't booked a ticket yet.<br>
                        Click on the 'BOOK NOW' button to book a new ticket.<br>
                        <p style='text-align:center;'><a href='reserve.php'><input type='button' class='BUTTON' value='BOOK NOW'></a></p>
                        <p style='text-align:center;'><a href='home.php'><input type='button' class='BUTTON' value='NOT NOW'></a></p>
                      </p>";
else {
    echo '<h1 style="text-align:center>BOOKINGS BY YOU</h1>';
    echo '<p style="text-align:center"><a href="home.php"><input type="button" value="Back to Home" class="BUTTON"></a></p>';
    $i = 1;
    echo "<br><br><hr>";
    while ($row = $details->fetch_assoc()) {
        echo "<h2>BOOKING NO: $i</h2>";
        echo "<h3>" . $row['FROM_LOC'] . " <---> " . $row['TO_LOC'] . "</h3>";
        $date = strtotime($row['DATED']);
        $dated = date('jS M Y', $date);
        echo "<h3> At " . $dated;
        echo "<h3 align='right'>Traveled by " . $row['NO_OF_SEATS'] . " Passengers.</h3>";
        echo "<hr>";
        $i++;
    }
    echo '<p style="text-align:center"><a href="surecancel.php"><input type="button" value="Cancel Bookings" class="BUTTON"></a></p>';
}
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>List of Bookings</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>
<style>
    h2 {
        text-align: center;
        font-family: consolas;
        font-size: 25px;
        color: aqua;
    }

    h3 {
        font-family: Cambria;
        color: cornflowerblue;
        font-size: 25px;
    }
</style>

<body>
</body>

</html>