<?php
error_reporting(0);
session_start(); // Make sure the session is started

$con = mysqli_connect("localhost", "root", "", "userdb");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// candidate data
$Chairman_query = "SELECT * FROM votes WHERE Voter_Name = '" . $_SESSION['fname'] . "' AND Candidate_Pos='Chairman';";
$Chairman_vote_data = mysqli_query($con, $Chairman_query);

if ($Chairman_vote_data) {
    // Count the number of rows returned
    $_SESSION["total_Chairman_vote"] = mysqli_num_rows($Chairman_vote_data);

    // Fetch the data and store the candidate's name in the session
    if ($row = mysqli_fetch_assoc($Chairman_vote_data)) {
        $_SESSION['Candidate_Name'] = $row['Candidate_Name']; // Assuming Candidate_Name is the column you want to store
    }
} else {
    echo "Error: " . mysqli_error($con);
}


// candidate data
$Vice_Chairman_query = "SELECT * FROM votes WHERE Voter_Name = '" . $_SESSION['fname'] . "' AND Candidate_Pos='Vice Chairman';";
$Vice_Chairman_vote_data = mysqli_query($con, $Vice_Chairman_query);

if ($Vice_Chairman_vote_data) {
    // Count the number of rows returned
    $_SESSION["total_Vice_Chairman_vote"] = mysqli_num_rows($Vice_Chairman_vote_data);

    // Fetch the data and store the candidate's name in the session
    if ($row = mysqli_fetch_assoc($Vice_Chairman_vote_data)) {
        $_SESSION['Vice_Chairman_Name'] = $row['Candidate_Name']; // Assuming Candidate_Name is the column you want to store
    }
} else {
    echo "Error: " . mysqli_error($con);
}


// candidate data
$Councilor_query = "SELECT * FROM votes WHERE Voter_Name = '" . $_SESSION['fname'] . "' AND Candidate_Pos='Councilor';";
$Councilor_vote_data = mysqli_query($con, $Councilor_query);

if ($Councilor_vote_data) {
    // Count the number of rows returned
    $_SESSION["total_Councilor_vote"] = mysqli_num_rows($Councilor_vote_data);

    // Fetch the data and store the candidate's name in the session
    if ($row = mysqli_fetch_assoc($Councilor_vote_data)) {
        $_SESSION['Councilor'] = $row['Candidate_Name']; // Assuming Candidate_Name is the column you want to store
    }
} else {
    echo "Error: " . mysqli_error($con);
}
mysqli_close($con); // Close the database connection
?>
