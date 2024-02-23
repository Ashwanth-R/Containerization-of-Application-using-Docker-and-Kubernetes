<?php
        $uname = $_POST['uName'];
        $mail = $_POST['User'];
        $crpass = $_POST['crpass'];
        $copass = $_POST['copass'];
     
        if ($crpass != $copass) {
            echo "<p>Passwords doesn't Match.<br>Account Creation failed.<br>
                  <a href='signup.html'><input type='button' value='Try again' class='BUTTON'></a></p>";
        }

        else {
            $conn = new mysqli("mysqldb", "root", "mypassword", "tickets");
            if ($conn->connect_error) 
                die("Connection failed: " . $conn->connect_error);

            $check = "SELECT UNAME,EMAIL_ID FROM USERS;";
            $result = $conn->query($check);
            $array1 = array();
            $array2 = array();
            while ($row = $result->fetch_assoc()) {
                $array1[] = $row['EMAIL_ID'];
                $array2[] = $row['UNAME'];
            }
            if (in_array($mail,$array1) || in_array($uname,$array2)) {
                if (in_array($mail,$array1)) 
                    echo "<p>There is already a user with the email id: '". $mail
                    . "'<br>Please try again with a newer mail</p>";
                if (in_array($uname,$array2)) 
                    echo "<p>There is already a user with the user name: '". $uname
                    . "'<br>Please try again with a newer user name
                    <br>Recommended: Try the format: 'Name_[any_numbers or symbols]'</p>";
                echo "<a href='signup.html'><input type='button' value='Try again' class='BUTTON'></a>";
            }
            else {
            $stmt = $conn->prepare("INSERT INTO USERS (UNAME,EMAIL_ID,PASSWORD) VALUES (?,?,?)"); 
            $stmt->bind_param("sss",$uname,$mail,$crpass);
            $stmt->execute(); 
            setcookie('USER',$uname);
            }
            $conn->close();
        }

    ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link rel="stylesheet" href="tickets.css">
    </head>
    <body>
        <p style='text-align:center;'> Registration Success. Please add some of your personal details to proceed.<br>
        <a href='profile.html'><input type='button' value='Go' class='BUTTON'></a></p>
    </body>
</html>