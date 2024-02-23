<?php 
        session_start();
        if (empty($_COOKIE['userName'])) {
            sleep(2);
            setcookie('info', 'Profile cannot be updated without login.');
            header("Location: login.php");
            exit(1); } 

        $uname = $_COOKIE['USERNAME'];
        $conn = new mysqli ("mysqldb", "root", "mypassword", "tickets");
        if ($conn->connect_error) 
            die("Connection failed: " . $conn->connect_error);

        $query = "DELETE FROM PROFILE WHERE UNAME = '$uname';";
        $conn->query($query);

        $name = $_POST['NAME'];
        $age = $_POST['AGE'];
        $gender = $_POST['GENDER'];
        $phone = $_POST['PHONE'];
        $door = $_POST['DOOR'];
        $street = $_POST['STREET'];
        $area = $_POST['AREA'];
        $city = $_POST['CITY'];
        $state = $_POST['STATE'];

        $query = "INSERT INTO PROFILE VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssississss",$uname,$name,$age,$gender,$phone,$door,$street,$area,$city,$state);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        sleep(2);
        setcookie('info','Your profile has been updated successfully.');
        setcookie('userName', $name);
        header("Location: home.php");
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Profile</title>
        <link rel="stylesheet" href="tickets.css">
    </head>
   