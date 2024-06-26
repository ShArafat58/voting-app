<?php
session_start();
error_reporting(0);

// Simulated user data for demonstration
$registered_users = [
    '1234567890' => [
        'fname' => 'John',
        'lname' => 'Doe',
        'idcard' => 'path/to/idcard.jpg',
        'status' => 'not voted'
    ]
];

if (isset($_POST['login'])) {
    $phone = $_POST['phone'];
    
    // Check if the phone number is in the simulated user data
    if (array_key_exists($phone, $registered_users)) {
        $user = $registered_users[$phone];
        
        $_SESSION['userLogin'] = 1;
        $_SESSION['phone'] = $phone;
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['lname'] = $user['lname'];
        $_SESSION['idcard'] = $user['idcard'];
        $_SESSION['status'] = $user['status'];

        header("Location: voted.php");
        exit();
    } else {
        $_SESSION['error'] = "Phone number not registered";
        header("Location: index.php");
        exit();
    }
}
?>
