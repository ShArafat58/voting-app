<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("SELECT fname, lname, idcard, status FROM register WHERE phone = ?");
    $stmt->bind_param("s", $phone);

    // Execute statement
    $stmt->execute();
    $stmt->store_result();

    // Bind result variables
    $stmt->bind_result($fname, $lname, $idcard, $status);

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        $_SESSION['userLogin'] = true;
        $_SESSION['phone'] = $phone;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['idcard'] = $idcard;
        $_SESSION['status'] = $status;

        $stmt->close(); // Close statement

        header("Location: voted.php");
        exit();
        
    } else {
        // User does not exist
        $_SESSION['error'] = "Phone number not registered";
        header("Location: index.php");
        exit();
    }
    
}
?>
