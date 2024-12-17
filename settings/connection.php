<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// * Local DB Config
$SERVER = "localhost"; // Changed from IP address to localhost
$USERNAME = "akua.oduro";
$PASSWD = "kikioduro1";
$DATABASE = "webtech_fall2024_akua_oduro";

// Create a new MySQLi connection with timeout settings
$con = mysqli_init();
mysqli_options($con, MYSQLI_OPT_CONNECT_TIMEOUT, 30); // Add 30-second timeout

if (!$con->real_connect($SERVER, $USERNAME, $PASSWD, $DATABASE)) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully!";
?>