<?php
session_start();
error_reporting(0);

$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "userdb";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    echo "<script>alert('Connection error!');</script>";
    die("Connection failed: " . $con->connect_error);
}

if ($_SESSION['userLogin'] != 1) {
    header("location:index.php");
}

$val_query = 'SELECT * FROM voting';
$val_data = mysqli_query($con, $val_query);
$val_result = mysqli_fetch_assoc($val_data);

$vot_start_date = $val_result['vot_start_date'];
$vot_end_date = $val_result['vot_end_date'];

$_SESSION['status'] = 'voted';
$showToast = isset($_SESSION['success']) && $_SESSION['success'] != '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <style>
        .result-box {
            display: none;
        }

        h4.heading {
            color: tomato;
        }
        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
        }
    </style>
</head>

<body>
    <div id="container">
        
        <div class="toast-container">
            <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php echo $_SESSION['success']; ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>


        <div id="header">
            <span class="logo">Voting System</span>
            <span class="profile" onclick="showProfile()">
                <img src="<?php echo $_SESSION['idcard']; ?>" alt="">
                <label><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></label>
            </span>
        </div>

        <!-- Profile Panel -->
        <div id="profile-panel">
            <span class="fa-solid fa-circle-xmark" onclick="hidePanel()"></span>
            <div class="dp"><img src="<?php echo $_SESSION['idcard']; ?>" alt=""></div>
            <div class="info">
                <h2><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h2>
            </div>
            <div class="link">
                <a href="includes/user-logout.php" class="del">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>

        <!-- Voting Tabs Start -->
        <div class="container mt-4 p-4 bg-white">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-Chairman-tab" data-bs-toggle="tab" data-bs-target="#nav-Chairman" type="button" role="tab" aria-controls="nav-Chairman" aria-selected="true">Chairman</button>
                    <button class="nav-link" id="nav-Vice_Chairman-tab" data-bs-toggle="tab" data-bs-target="#nav-Vice_Chairman" type="button" role="tab" aria-controls="nav-Vice_Chairman" aria-selected="false">Vice Chairman</button>
                    <button class="nav-link" id="nav-Councilor-tab" data-bs-toggle="tab" data-bs-target="#nav-Councilor" type="button" role="tab" aria-controls="nav-Councilor" aria-selected="false">Councilor</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane pt-4 fade show active" id="nav-Chairman" role="tabpanel" aria-labelledby="nav-Chairman-tab">
                    <table class="table">
                        <thead>
                            <th>Candidate Name</th>
                            <th>Candidate Symbol</th>
                            <th>Symbol Image</th>
                            <th>Position</th>

                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php

                            include "./includes/all-select-data.php";
                            include "./includes/all-votes-data.php";

                            while ($result = mysqli_fetch_assoc($chair_data)) {
                                echo "<tr>
                                <td>" . $result['cname'] . "</td>
                                <td>" . $result['symbol'] . "</td>
                                <td><a href='" . $result['symphoto'] . "'><img src='" . $result['symphoto'] . "'></a></td>
                                <td>" . $result['position'] . "</td>
                                <td>";

                                // Check if candidate name matches and total votes are greater than 0
                                if ($_SESSION["total_Chairman_vote"] > 0 && $result['cname'] == $_SESSION['Candidate_Name']) {
                                    echo "<span class='status'>Voted</span>";
                                } else {
                                    // If total votes are 0 or candidate name does not match, show the Vote button
                                    if ($_SESSION["total_Chairman_vote"] == 0) {
                                        echo "<a href='cand-update.php?cn=" . $result['cname'] . "&sy=" . $result['symbol'] . "&ps=" . $result['position'] . "&fname=" . $_SESSION['fname'] . "' class='edit'>
                    Vote
                  </a>";
                                    }
                                }

                                echo "</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade pt-4" id="nav-Vice_Chairman" role="tabpanel" aria-labelledby="nav-Vice_Chairman-tab">
                    <table class="table">
                        <thead>
                            <th>Candidate Name</th>
                            <th>Candidate Symbol</th>
                            <th>Symbol Image</th>
                            <th>Position</th>

                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php

                            include "./includes/all-select-data.php";
                            include "./includes/all-votes-data.php";

                            while ($result = mysqli_fetch_assoc($v_chair_data)) {
                                echo "<tr>
                                    <td>" . $result['cname'] . "</td>
                                    <td>" . $result['symbol'] . "</td>
                                    <td><a href='" . $result['symphoto'] . "'><img src='" . $result['symphoto'] . "'></a></td>
                                    <td>" . $result['position'] . "</td>
                                    <td>";

                                // Check if candidate name matches and total votes are greater than 0
                                if ($_SESSION["total_Vice_Chairman_vote"] > 0 && $result['cname'] == $_SESSION['Vice_Chairman_Name']) {
                                    echo "<span class='status'>Voted</span>";
                                } else {
                                    // If total votes are 0 or candidate name does not match, show the Vote button
                                    if ($_SESSION["total_Vice_Chairman_vote"] == 0) {
                                        echo "<a href='cand-update.php?cn=" . $result['cname'] . "&sy=" . $result['symbol'] . "&ps=" . $result['position'] . "&fname=" . $_SESSION['fname'] . "' class='edit'>
                                            Vote
                                            </a>";
                                    }
                                }

                                echo "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade pt-4" id="nav-Councilor" role="tabpanel" aria-labelledby="nav-Councilor-tab">
                    <table class="table">
                        <thead>
                            <th>Candidate Name</th>
                            <th>Candidate Symbol</th>
                            <th>Symbol Image</th>
                            <th>Position</th>

                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php

                            include "./includes/all-select-data.php";
                            include "./includes/all-votes-data.php";

                            while ($result = mysqli_fetch_assoc($councilor_data)) {
                                echo "<tr>
        <td>" . $result['cname'] . "</td>
        <td>" . $result['symbol'] . "</td>
        <td><a href='" . $result['symphoto'] . "'><img src='" . $result['symphoto'] . "'></a></td>
        <td>" . $result['position'] . "</td>
        <td>";

                                // Check if candidate name matches and total votes are greater than 0
                                if ($_SESSION["total_Councilor_vote"] > 0 && $result['cname'] == $_SESSION['Councilor']) {
                                    echo "<span class='status'>Voted</span>";
                                } else {
                                    // If total votes are 0 or candidate name does not match, show the Vote button
                                    if ($_SESSION["total_Councilor_vote"] == 0) {
                                        echo "<a href='cand-update.php?cn=" . $result['cname'] . "&sy=" . $result['symbol'] . "&ps=" . $result['position'] . "&fname=" . $_SESSION['fname'] . "' class='edit'>
                    Vote
                  </a>";
                                    }
                                }

                                echo "</td></tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Voting Tabs End -->

        <div class="result-box">
            <h2 class="result-title">Voting Result</h2>
            <?php
            $i = 0;
            while ($i < $total_pos) {
                echo '
                        <div class="result"><canvas class="myChart"></canvas></div>
                        ';
                $i++;
            }
            ?>
        </div>
    </div>

    <!-- JavaScript and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="js/script.js"></script>
    <script src="js/chart.js"></script>

    <script>

        <?php if ($showToast): ?>
        var toastElement = document.getElementById('successToast');
        var toast = new bootstrap.Toast(toastElement);
        toast.show();
        <?php endif; ?>


        // PHP to JS variables
        var vot_start_date = "<?php echo $vot_start_date; ?>";
        var vot_end_date = "<?php echo $vot_end_date; ?>";
        console.log(vot_end_date);

        // Convert to milliseconds
        var start_date = Date.parse(vot_start_date);
        var end_date = Date.parse(vot_end_date);
        var current_date = Date.parse(new Date());

        start_vot = start_date - current_date;
        end_vot = end_date - current_date;

        var vresult = document.getElementsByClassName("result-box");
        var heading = document.getElementsByClassName("heading");

        // Start voting
        setTimeout(() => {
            vresult["0"].style.display = "none";
        }, start_vot);

        // End voting
        setTimeout(() => {
            vresult["0"].style.display = "block";
            heading["1"].style.display = "none";
        }, end_vot);

        // Voting result chart setup
        var ctx = [];
        var myChart = [];
        <?php include "includes/candidate_result.php"; ?>
    </script>
</body>

</html>