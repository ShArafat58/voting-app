<?php
session_start();
error_reporting(0);

$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<script>alert('Connection error!');</script>";
    die("Connection failed: " . $conn->connect_error);
}

?>
