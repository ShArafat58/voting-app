<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Collect form data
$id = NULL;
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$idname = $_POST['idname'];
$idnum = $_POST['idnum'];
$instidnum = $_POST['instidnum'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$verify = 'No';
$status = 'Not Voted';

// Check if the register button was clicked
if (isset($_POST['register'])) {
    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "userdb");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Calculate age
    $date1 = new DateTime("$dob");
    $date2 = new DateTime("now");
    $dateDiff = $date1->diff($date2);

    // Validate inputs
    if (strlen($phone) != 11) {
        echo "<script> 
                alert('Phone Number must be 11 digits');
                history.back();
              </script>";
    } elseif (!is_numeric($phone)) {
        echo "<script> 
                alert('Phone Number must be numeric');
                history.back();
              </script>";
    } elseif (strlen($idnum) > 13) {
        echo "<script> 
                alert('Enter a valid ID number');
                history.back();
              </script>";
    } elseif ($dateDiff->days < 6570) { // 18 years in days
        echo "<script>
                alert('Your age must be above 18 years');
                history.back();
              </script>";
    } else {
        // Handle file upload
        $filename = "img/4R (1).jpg";
        // $filename = $_FILES["idcard"]["name"];
        $tempname = $_FILES["idcard"]["tmp_name"];
        $folder = "img/" . basename($filename);
        move_uploaded_file($tempname, $folder);

        // Prepare the SQL statement
        $stmt = $con->prepare("INSERT INTO register (id, fname, lname, idname, idnum, idcard, inst_id, dob, gender, phone, address, verify, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            echo "Error preparing statement: " . $con->error;
            exit();
        }

        // Bind parameters
        $stmt->bind_param("issssssssssss", $id, $fname, $lname, $idname, $instidnum, $filename, $instidnum, $dob, $gender, $phone, $address, $verify, $status);
        echo "DB bind params\n";

        // Execute the statement
        if ($stmt->execute()) {
            echo "Record inserted successfully\n";
            // Redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error . "\n";
        }

        // Close the statement
        $stmt->close();

        // Close the connection
        $con->close();
    }
}
