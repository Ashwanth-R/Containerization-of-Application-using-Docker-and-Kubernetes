<?php
$host = 'mysqldb';
$dbname = 'tickets';
$username = 'root';
$password = 'mypassword';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // create the database if it doesn't exist
    $stmt = $pdo->prepare("CREATE DATABASE IF NOT EXISTS $dbname");
    $stmt->execute();


    // switch to the database
    $pdo->exec("USE $dbname");

    // create the tables
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS AVAILS (DEP_DATE DATE NOT NULL PRIMARY KEY, SEATS INT NOT NULL)");
    $stmt->execute();
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS BOOKINGS (BOOKID INT NOT NULL,USER_NAME VARCHAR(20) NOT NULL, FROM_LOC VARCHAR(20) NOT NULL, TO_LOC VARCHAR(20) NOT NULL, PH_NO BIGINT(10) NOT NULL, PREF VARCHAR(20) NOT NULL, NO_OF_SEATS INT NOT NULL, DATED DATE NOT NULL)");
    $stmt->execute();
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS PROFILE (UNAME VARCHAR(20) NOT NULL, NAME VARCHAR(20) NOT NULL, AGE INT NOT NULL, GENDER CHAR(1) NOT NULL, PH_NO BIGINT(10) NOT NULL, DOOR_NO INT NOT NULL, STREET VARCHAR(50) NOT NULL, AREA VARCHAR(20) NOT NULL, CITY VARCHAR(20) NOT NULL, STATE VARCHAR(20) NOT NULL)");
    $stmt->execute();
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS USERS (UNAME VARCHAR(20) NOT NULL, EMAIL_ID VARCHAR(50) NOT NULL, PASSWORD VARCHAR(50) NOT NULL)");
    $stmt->execute();
    $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS DETAILED_BOOKINGS (BOOKID INT NOT NULL,UNAME VARCHAR(20) NOT NULL, NAME VARCHAR(20) NOT NULL, AGE INT NOT NULL, GENDER CHAR(1) NOT NULL, COST REAL NOT NULL)");
    $stmt->execute();
    // insert data into the AVAILS table
    $str = "2023-07-01";
    $i = 1;
    $r = 1;
    $avails = 200;

    while ($i <= 30) {
        $div = $i++ % 10;
        if (!$div)
            $str[strlen($str) - 2] = "" . $r++;

        $str[strlen($str) - 1] = "" . $div;

        $stmt = $pdo->prepare("INSERT INTO AVAILS VALUES (?,?)");
        $stmt->execute([$str, $avails]);
    }
    $stmt = $pdo->prepare("commit");
    $stmt->execute();

    echo "Tables and data created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>