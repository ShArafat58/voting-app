<?php
// error_reporting(0);
$conn = mysqli_connect("localhost","root","","userdb");


if (isset($_GET['cname']) && isset($_GET['position']) && isset($_GET['symbol']) && isset($_GET['symphoto'])) {
    $cname = $_GET['cname'];
    $position = $_GET['position'];
    $symbol = $_GET['symbol'];
    $symphoto = $_GET['symphoto'];


    // Prepare the SQL INSERT query
    $sql = "INSERT INTO candidate (cname, symbol, symphoto, position, tvotes) 
        VALUES ( '$cname', '$symbol', '$symphoto', '$position', 0)";


    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Set success message
        $_SESSION['success'] = "Your Candidate has been added!";
        echo $_SESSION['success'];

        // Redirect to voted.php
        header("Location: candidates.php");
        exit();
 
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
    }
}


?>