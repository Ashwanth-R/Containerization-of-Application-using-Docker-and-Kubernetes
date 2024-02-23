<?php
        session_start();

        if ( !(empty($_COOKIE['userMail'])) && !(empty($_COOKIE['userPass']))) {
            $mail = $_COOKIE['userMail'];
            $pass = $_COOKIE['userPass'];
        }
        else {
            $mail = $_POST['User'];
            $pass = $_POST['pass'];
        }

        $conn = new mysqli("mysqldb", "root", "mypassword", "tickets");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $check = "SELECT EMAIL_ID FROM USERS;";
        $result = $conn->query($check);
        $array = array();
        while ($row = $result->fetch_assoc()) {
            $array[] = $row['EMAIL_ID'];
        }

        if (! (in_array($mail,$array))) {
            echo "<p>No mail called '" .$mail. "' found.<br>Please check whether you've registered this email.</p>";
            echo "<a href='login.php'><input type='button' value='Try again' class='BUTTON'></a>";
            echo '<p>Not having account?. Please <a href="signup.html"><input type="button" value="Sign Up" class="BUTTON"></a></p>';
        }

        else {
            $check = "SELECT PASSWORD FROM USERS WHERE EMAIL_ID = '" .$mail. "';";
            $result = $conn->query($check);
            $res = $result->fetch_assoc();
            
            if ($pass != $res['PASSWORD']) {
                echo "<p>Please check with your password.<br>You've entered an incorrect password</p>";
                echo "<a href='login.php'><input type='button' value='Try again' class='BUTTON'></a>";
            }

            else {
                $check = "SELECT UNAME FROM USERS WHERE EMAIL_ID = '" .$mail. "';";
                $result = $conn->query($check);
                $name = $result->fetch_assoc();

                $user = $name['UNAME'];
                setcookie('USERNAME',$user);

                $check = "SELECT NAME FROM PROFILE WHERE UNAME = '" .$user. "';";
                $result = $conn->query($check);
                $name = $result->fetch_assoc();

                $user = $name['NAME'];
                setcookie('userName',$user);

                sleep(2);
                header("Location: home.php");
               // echo "<a href='reserve.html'><input type='button' value='BOOK NOW' class='BUTTON'></a>";
            }
        }
        $conn->close();
    ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link rel="stylesheet" href="tickets.css">
    </head>
    <body>
        <h1>HOME</h1>
    </body> 

    <script>
        if (window.history && window.history.pushState) {
            window.history.pushState('', null, './');
            window.addEventListener('popstate', function() {
                window.history.pushState('', null, './');
            });
        }
    </script>
</html>