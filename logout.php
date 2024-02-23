<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Delete any cookies associated with the user
setcookie('userMail', '');
setcookie('userPass', '');
setcookie('userName', '');

// Redirect the user to the login page
header('Location: login.php');
exit;
?>
