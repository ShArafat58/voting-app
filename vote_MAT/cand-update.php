<?php
error_reporting(0);
$conn = mysqli_connect("localhost","root","","userdb");



if (isset($_GET['cn']) && isset($_GET['ps']) && isset($_GET['fname'])) {
    $cname = $_GET['cn'];
    $position = $_GET['ps'];
    $fname = $_GET['fname'];



    // Prepare the SQL INSERT query
    $sql = "INSERT INTO Votes (Candidate_Name, Candidate_Pos, Voter_Name) 
            VALUES ('$cname', '$position', '$fname')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Set success message
        $_SESSION['success'] = "Your vote has been successfully recorded!";
        // Redirect to voted.php
        header("Location: voted.php");
        exit();
 
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "Required parameters are missing!";
}


?>
