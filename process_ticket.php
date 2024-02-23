<?php
    ob_start();
    session_start();
    setcookie('toloc', $_POST['to']);
    setcookie('preference', $_POST['preference']);
    setcookie('seats', $_POST['seats']);
    setcookie('date', $_POST['date']);
    setcookie('fromloc', $_POST['from']);
    if (empty($_COOKIE['userName'])) {
        sleep(2);
        setcookie('info','You cannot go to next step without login.');
        header("Location: login.php");
        exit(1);
    }

    // Retrieve form data
    $seats = $_POST['seats'];
    $date = $_POST['date'];

    // Create connection
    $conn = new mysqli("mysqldb", "root", "mypassword", "tickets");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert form data into the database
    $query = "SELECT SEATS FROM AVAILS WHERE DEP_DATE = '" .$_POST['date']. "';";
    $result = $conn->query($query);
    $remaining = $result->fetch_assoc();

    if ($remaining['SEATS'] >= $seats) {
        echo "<p>Congratulations!. You have to add few details about your members.</p>"; 
        echo '<form action="payment.php" method="POST">
                <table align="center">';
        $name = $_COOKIE['USERNAME'];

        $query = "SELECT PH_NO FROM PROFILE WHERE UNAME = '" .$name. "';";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        setcookie('phone',$row['PH_NO']);
        // setcookie('phone',$row['PH_NO']);
        // setcookie('fromloc', $_POST['from']);
        // setcookie('toloc', $_POST['to']);
        // setcookie('preference', $_POST['preference']);
        // setcookie('seats', $_POST['seats']);
        // setcookie('date', $_POST['date']);
        $i = 1;
        while ($i <= $seats) {
            echo '<tr>
                    <td>
                        <span>Enter Name of passenger ' .$i. ':</span><br>
                        <input type="text" name="name' .$i. '" class="booking" required>
                    </td>
                    <td>
                        <span>Enter his/her age:</span><br>
                        <input type="number" name="age' .$i. '" class="booking" required max="150;">
                    </td>
                    <td>
                        <span>Enter the Gender:</span><br>
                        <select name="gender' .$i++. '">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Others</option>
                        </select>
                    </td>
                </tr>';
        }
        echo '</table>
                <input type="submit" value="Proceed" class="BUTTON"></form>';
    } else if ($remaining['SEATS']) {
        echo "<p>Available only for ". $remaining['SEATS'] ." passengers at date '$date'. Please try the same booking with fewer people or in another day.</p>";
    } else 
        echo "<p>All seats have been booked at  date '$date'.  Please try the same booking in some other day.</p>";
    ob_end_flush();
    ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Train Ticket Reservation System</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
   </head>
   <body>
        <h1>TRAIN RESERVATION</h1>

</body>
</html>
