<?php
session_start();
if (empty($_COOKIE['userName'])) {
   #sleep(2);
   setcookie('info', 'Tickets cannot be booked without login.');
   header("Location: login.php");
   exit(1);
}
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
   <form action="process_ticket.php" method="POST">
      <table align="center">
         <tr>
            <td><label for="from"><span>From Location</span></label></td>
            <td><input type="text" name="from" required id="floc" class="booking"></td>
         </tr>
         <tr>
            <td><label for="to"><span>To Location</span></label></td>
            <td><input type="text" name="to" required id="tloc" class="booking"></td>
         </tr>
         <tr>
            <td><label for="preference"><span>Preference</span></label></td>
            <td>
               <select name="preference">
                  <option value="First class Cum AC">First Class Cum AC</option>
                  <option value="AC 2 Tier">AC 2 Tier</option>
                  <option value="AC 3 Tier">AC 3 Tier</option>
                  <option value="Sleeper">Sleeper</option>
                  <option value="Second class">Second class</option>
               </select>
            </td>
         </tr>
         <tr>
            <td><label for="seats"><span>Enter Passenger Count</span></label></td>
            <td><input type="number" name="seats" min="1" max="10" required class="booking"></td>
         </tr>
         <tr>
            <td><label for="date"><span>Travel Date</span></label></td>
            <td><input type="date" name="date" required id="dates" class="booking"></td>
         </tr>
      </table>
      <div id="button1"></div>
   </form>
   <form action="home.php">
      <p style="text-align: center;"><input type="submit" value="Abort" class="BUTTON"></p>
   </form>
</body>
<script>
   document.getElementById("button1").innerHTML = "<p style='text-align: center;'><input type='button' value='Next' class='BUTTON' onclick='check();'></p>";
   function check() {
      departs = document.getElementById("floc").value.toUpperCase();
      arrives = document.getElementById("tloc").value.toUpperCase();
      journ = document.getElementById("dates").value;

      today = new Date();
      y = today.getFullYear();
      m = today.getMonth() + 1;
      d = today.getDate();

      if (m < 10) m = '0' + m;
      if (d < 10) d = '0' + d;
      today = y + '-' + m + '-' + d;
      if (departs == "" || arrives == "" || journ == "")
         alert("All the fields are mandatory.");
      else if (journ < today || departs == arrives || journ < '2023-06-01') {
         if (departs == arrives)
            alert("No trains available for same two cities.");
         if ((journ < '2023-06-01' && journ >= today) || journ > '2023-06-30')
            alert("Sorry. Tickets available only between June 1st and June 30th.")
         if (journ < today)
            alert("Booking date must be after today's date.\n(Today's date: " + today + ").");
      }
      else {
         document.getElementById("button1").innerHTML = "<p style='text-align: center;'><input type='submit' value='Next' class='BUTTON'></p>";
         alert("Wow! Everything looks good. Now again click next button to proceed.\nMake sure you have passengers count between 1 and 10.")
      }
   }
</script>

</html>