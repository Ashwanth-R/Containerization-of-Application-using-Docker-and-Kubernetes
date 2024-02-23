<html>
    <title>DETAILS OF ALL PASSENGERS</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
<?php 

    $conn = new mysqli("mysqldb", "root", "mypassword", "TICKETS");

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM BOOKINGS;";
    $result = $conn->query($query);

   
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table align='center'>";
        echo "<tr>";
        echo "<td class='header'><span>Name</span></td>";
        echo "<td class='header'><span>Email</span></td>";
        echo "<td class='header'><span>Phone</span></td>";
        echo "<td class='header'><span>Train Category</span></td>";
        echo "<td class='header'><span>Passenger Count</span></td>";
        echo "<td class='header'><span>Departure Date</span></td>";
        echo "</tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><p>".$row["NAME"]."</p></td>";
            echo "<td><p>".$row["EMAIL_ID"]."</p></td>";
            echo "<td><p>".$row["PH_NO"]."</p></td>";
            echo "<td><p>".$row["TRAIN_NAME"]."</p></td>";
            echo "<td><p>".$row["NO_OF_SEATS"]."</p></td>";
            echo "<td><p>".$row["DATE"]."</p></td>";
            echo "</tr>";
        }
        echo "</table>";
        $query = "SELECT SUM(NO_OF_SEATS) FROM BOOKINGS";
        $result = $conn->query($query);

        $row = $result->fetch_assoc();
        echo "<p>No of seats remaining: ". 25 - $row["SUM(NO_OF_SEATS)"]. "</p>";
     } else {
        echo "0 results";
     }

    $conn->close();

?>

</html>