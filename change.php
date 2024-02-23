<?php
session_start();
if (!empty($_COOKIE['userName'])) {
    $pass = $_POST['current'];
    $new = $_POST['new'];
    $confirm = $_POST['confirm'];
    $user = $_COOKIE['USERNAME'];
    $conn = new mysqli("mysqldb", "root", "mypassword", "tickets");
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);

    $result = $conn->query("SELECT PASSWORD FROM USERS WHERE UNAME = '$user'");
    $row = $result->fetch_assoc();
    if ($row['PASSWORD'] != $pass) {
        echo '<script>alert("Invalid current password.\nClick on Try again to proceed.");</script>';
        echo "<a href='change.html'><input type='button' value='Try again' class='BUTTON'></a>";
        $conn->close();
    } else if ($new != $confirm) {
        echo '<script>alert("New Passwords don\'t match.\nClick on Try again to proceed.");</script>';
        echo "<a href='change.html'><input type='button' value='Try again' class='BUTTON'></a>";
        exit(0);
    } else {
        $stmt = $conn->prepare("UPDATE USERS SET PASSWORD = ? WHERE UNAME = ?;");
        $stmt->bind_param("ss", $new, $user);
        $stmt->execute();
        setcookie('info', 'Password has been updated successfully.');
        sleep(2);
        header("Location: home.php");
        $conn->close();
    }
} else {
    sleep(2);
    setcookie('info', 'Please login to change your password.');
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>
    <h1>CHANGE PASSWORD</h1>
</body>

</html>