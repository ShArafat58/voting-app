<?php
error_reporting(0);
$con = mysqli_connect("localhost","root","","userdb");

// candidate data
$can_query="SELECT * FROM candidate;";
$can_data=mysqli_query($con,$can_query);


$_SESSION["total_cand"]=mysqli_num_rows($can_data);
$total_cand=mysqli_num_rows($can_data);

$chair_query="SELECT * FROM candidate WHERE position = 'Chairman';";
$chair_data=mysqli_query($con, $chair_query);

$v_chair_query="SELECT * FROM candidate WHERE position = 'Vice Chairman';";
$v_chair_data=mysqli_query($con, $v_chair_query);

$councilor_query="SELECT * FROM candidate WHERE position = 'Councilor';";
$councilor_data=mysqli_query($con, $councilor_query);

// user register data
$voter_query="SELECT * FROM register WHERE verify = 'yes';";
$voter_data=mysqli_query($con,$voter_query);
$_SESSION["total_voters"]=mysqli_num_rows($voter_data);

// candidate position data
$pos_query="SELECT * FROM can_position;";
$pos_data=mysqli_query($con,$pos_query);
$_SESSION["total_position"]=mysqli_num_rows($pos_data);
$total_pos=mysqli_num_rows($pos_data);

?>