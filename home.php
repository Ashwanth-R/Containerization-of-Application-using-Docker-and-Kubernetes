<?php
session_start();
if (empty($_COOKIE['userName'])) {
    sleep(2);
    header("Location: login.php");
    exit(1);
}
date_default_timezone_set('Asia/Kolkata');
$current_time = time();
$hrs = date('H', $current_time);

echo "<title>" . $_COOKIE['userName'] . "</title>";

if ($hrs >= 0 && $hrs < 12)
    echo "<table><tr><td><p>Good Morning " . $_COOKIE['userName'] . " </p>";
else if ($hrs >= 12 && $hrs < 17)
    echo "<table><tr><td><p>Good Afternoon " . $_COOKIE['userName'] . " </p>";
else
    echo "<table><tr><td><p>Good Evening " . $_COOKIE['userName'] . " </p>";


if (!empty($_COOKIE['info'])) {
    #$string = $_COOKIE['info'];
    #echo "<p>$string</p>";
    sleep(2);
    #setcookie("info",''); 
}
?>

<head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>
<style>
    .CLOCK {
        font-family: cursive;
        font-size: 35px;
        color: hotpink;
    }

    td {
        width: 100%;
    }

    .icon {
        height: 50px;
        width: 50px;
    }
</style>
<!DOCTYPE html>
<html>

<head>
    <title>CONTACTS</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>
    <div id='clock' align='center' class='CLOCK'></div>
    <p>Start with a booking.</p>
    </td>
    <td align='right'>
        <a href='myprofile.php'><img src='PROFILE.png' class='icon' title='My Profile'></a><br><br>
        <a href='reserve.php'><img src='BOOK.png' title='Book a new ticket' class='icon'></a><br><br>
        <a href='bookings.php'><img src='BOOKINGS.png' class='icon' title='List of bookings'></a><br><br>
        <a href='change.html'><img src='CHANGE.png' class='icon' title='Change my Password'></a><br><br>
        <a href='areusure.php'><img src='LOGOUT.png' class='icon' title='Log out'></a>
    </td>
    </tr>
    </table>
</body>

</html>
<script src="TIME.js"></script>