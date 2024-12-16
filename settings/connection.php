<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// * Local DB Config
$SERVER = "localhost";
$USERNAME = "root";
$PASSWD = "";
$DATABASE = "vogueverse";

// Create a new MySQLi connection
$con = new mysqli($SERVER, $USERNAME, $PASSWD, $DATABASE);

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// echo "Connected successfully!";
?>
