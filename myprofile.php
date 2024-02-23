<?php
session_start();
if (empty($_COOKIE['userName'])) {
    setcookie('info', 'Your profile cannot be viewed without login.');
    header("Location: login.php");
    exit(1);
}

$uname = $_COOKIE['USERNAME'];
$conn = new mysqli("mysqldb", "root", "mypassword", "tickets");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$query = "SELECT * FROM PROFILE WHERE UNAME = '$uname';";
$result = $conn->query($query);

if (mysqli_num_rows($result) == 0) {
    echo "<p>
                            You haven't filled your personal details yet.<br>
                            Click on <a href='profile.html'><input type='button' value='Register' class='BUTTON'> button to register.</a>
                          </p>";
}

$row = $result->fetch_assoc();
$user = $row['UNAME'];
$name = $row['NAME'];
$age = $row['AGE'];
$gender = $row['GENDER'];
$phone = $row['PH_NO'];
$ADDRESS = $row['DOOR_NO'] . ', ' . $row['STREET'] . ', ' . $row['AREA'] . '<BR>' . $row['CITY'] . '<BR>' . $row['STATE'];

if ($gender == 'M')
    $g = 'Male';
else if ($gender == 'F')
    $g = 'Female';
echo '
                    <table align="center">
                        <tr>
                            <td><span>User Name</span></td>
                            <td>' . $user . '</td>
                        </tr>
                        <tr>
                            <td><span>Name</span></td>
                            <td>' . $name . '</td>
                        </tr>
                        <tr>
                            <td><span>Age</span></td>
                            <td>' . $age . '</td>
                        </tr>
                        <tr>
                            <td><span>Gender</span></td>
                            <td>' . $g . '</td>
                        </tr>
                        <tr>
                            <td><span>Phone no</span></td>
                            <td>' . $phone . '</td>
                        </tr>
                        <tr>
                            <td><span>Address</span></ td>
                            <td>' . $ADDRESS . '</td>
                        </tr>
                        <tr>
                            <td>
                                <div align="right">
                                    <br><a href="home.php"><img src="HOME.png" title="Home" height="50px" width="50px"></a>
                                </div>    
                            </td>
                            <td>
                                <div align="left">
                                    <br><a href="edit.php"><img src="UPDATE.png" title="Edit my profile" height="50px" width="50px"></a>
                                </div>
                            </td>
                    </table>';

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>
<style>
    td {
        font-size: 25px;
        width: 50%;
    }
</style>

<body>

    <h1>MY PROFILE</h1>
    <br><br>
    <div id='clock' align='center' class='CLOCK'></div>
    <br><br>
    <script src="TIME.js"></script>