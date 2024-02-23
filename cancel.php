<?php 
    ob_start();
    session_start();
    $conn = new mysqli ("mysqldb", "root", "mypassword", "tickets");
    $name = $_COOKIE['USERNAME'];
    $bookid = $_COOKIE['bookid'];
    // $query = "SELECT NO_OF_SEATS,DATED FROM BOOKINGS WHERE USER_NAME = '$name' AND BOOKID = $bookid;";
    // $row = $conn->query($query);
    $query = "SELECT NO_OF_SEATS,DATED FROM BOOKINGS WHERE USER_NAME = ? AND BOOKID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $name, $bookid);
    $stmt->execute();
    $result = $stmt->get_result();
    $res = $result->fetch_assoc();
    $seats = $res['NO_OF_SEATS'];
    $date = $res['DATED'];

    $query = "DELETE FROM BOOKINGS WHERE USER_NAME = ? AND BOOKID = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $name, $bookid);
    $stmt->execute();

    $query = "DELETE FROM DETAILED_BOOKINGS WHERE UNAME = ? AND BOOKID = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $name, $bookid);
    $stmt->execute();

    $query = "SELECT SEATS FROM AVAILS WHERE DEP_DATE = '$date';";
    $row = $conn->query($query);
    $res = $row->fetch_assoc();
    $rem = $res['SEATS'];
    $seats += $rem;
    $query = "UPDATE AVAILS SET SEATS = ? WHERE DEP_DATE = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $seats, $date);
    $stmt->execute();

    $query = "UPDATE BOOKINGS SET BOOKID = BOOKID - 1 WHERE USER_NAME = '$name' AND BOOKID > $bookid;";
    $conn->query($query);
    $query = "UPDATE DETAILED_BOOKINGS SET BOOKID = BOOKID - 1 WHERE UNAME = '$name' AND BOOKID > $bookid;";
    $conn->query($query);

    $conn->close();

    sleep(2);
    setcookie('info','Booking has been canceled successfully');
    setcookie('bookid','');
    header("Location: home.php");
    ob_end_flush();
    exit(1);
?>