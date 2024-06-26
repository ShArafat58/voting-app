<?php
// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: index.php");
    exit;
}

// Define login credentials (for demonstration purposes, typically fetched from a database)
$admin_email = "admin@example.com";
$admin_password = "password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate credentials
    if ($email == $admin_email && $password == $admin_password) {
        $_SESSION['loggedin'] = true;
        header("location: index.php");
    } else {
        $login_error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login_styles.css">
</head>
<body>
    <div class="login-container">
        <form action="admin_login.php" method="post">
            <h2>Admin Login</h2>
            <?php
            if (!empty($login_error)) {
                echo '<p style="color:red;">' . $login_error . '</p>';
            }
            ?>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
