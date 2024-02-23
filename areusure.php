<?php
#session_start();
if (empty($_COOKIE['userName'])) {
    sleep(2);
    setcookie('info', 'Left button is inaccessible after logout.');
    header("Location: login.php");
    exit(1);
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="tickets.css">
</head>

<body>
    <span style='text-align:center;'>Are you sure?</span>
    <p style='text-align:center;'>
        <a href='logout.php'><input type='button' class='BUTTON' value='Yes'></a>
        <a href='home.php'><input type='button' class='BUTTON' value='No'></a>
    </p>
</body>

</html>
<script>
    // JavaScript code
    if (window.history && window.history.pushState) {
        window.history.pushState('', null, '');
        window.addEventListener('popstate', function () {
            location.reload();
        });
    }
</script>