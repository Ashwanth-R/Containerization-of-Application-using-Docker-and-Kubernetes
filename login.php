<?php
session_start();
if (isset($_COOKIE['userMail'])) {
    unset($_COOKIE['userMail']);
    setcookie('userMail', '');
}

if (isset($_COOKIE['userName'])) {
    unset($_COOKIE['userName']);
    setcookie('userName', '');
}

if (isset($_COOKIE['userPass'])) {
    unset($_COOKIE['userPass']);
    setcookie('userPass', '');
}

if (!empty($_COOKIE['info'])) {
    $string = $_COOKIE['info'];
    #echo "<p>$string</p>";
    setcookie('info',''); 
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Open Page</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>
    <h1>LOGIN</h1>
    <form action="lsuccess.php" method="POST">
        <table align="center">
            <tr>
                <td><span>Email</span></td>
                <td class="Inputs"><input type="email" name="User" required></td>
            </tr>
            <tr>
                <td><span>Password</span></td>
                <td><input type="password" name="pass" required></td>
            </tr>
        </table>
        <p style="text-align: center;"><input type="submit" value="Submit" class='BUTTON'></p>
        <p style="text-align: center;"><a href="train_ticket_reservation.html"><input type="button"
                    value="Exit to general home" class='BUTTON'></a></p>
    </form>
    <p style="text-align: center;">Not having account?. Please <a href="signup.html"><input type="button" value="Sign Up" class='BUTTON'></a></p>
</body>

</html>
<script>
    if (window.history && window.history.pushState) {
        window.history.pushState('', null, './');
        window.addEventListener('popstate', function () {
            window.history.pushState('', null, './');
        });
    }
</script>