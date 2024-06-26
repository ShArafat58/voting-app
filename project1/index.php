<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <a href="logout.php" class="logout">Logout</a>
        <h1 class="page-title">Admin Page</h1>
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="#">Candidates Position</a></li>
                <li><a href="#">Candidates Name</a></li>
                <li><a href="#">Voter Reg</a></li>
                <li><a href="#">Voters</a></li>
                <li><a href="#">Voting Time</a></li>
                <li><a href="#">Result</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
