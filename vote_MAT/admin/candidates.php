<?php
session_start();
if ($_SESSION['adminLogin'] != 1) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
</head>
<style>
    .form {
        position: absolute;
        background: #fff;
        border-radius: 0rem;
        box-shadow: none;
        margin: 1rem;
        height: 0rem;
    }

    .add-btn {
        text-decoration: none;
    }
</style>

<body>
    <div id="container">
        <div id="header">
            <span class="menu-bar" id="show" onclick="showMenu()">&#9776;</span>
            <span class="menu-bar" id="hide" onclick="hideMenu()">&#9776;</span>
            <span class="logo">Voting System</span>
            <span class="profile" onclick="showProfile()"><img src="../res/10.png" alt=""><label for=""><?php echo $_SESSION['name']; ?></label></span>
        </div>
        <div id="profile-panel">
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()"></i>
            <div class="dp"><img src="../res/10.jpng" alt=""></div>
            <div class="info">
                <h2><?php echo $_SESSION['name']; ?></h2>
                <h5>Admin</h5>
            </div>
            <div class="link"><a href="../includes/admin-logout.php" class="del"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></div>
        </div>
        <?php include '../includes/menu.php'; ?>
        <div id="main">
            <div class="heading"><button type="button" class="add-btn" data-toggle="modal" data-target="#exampleModal">
                    + Add
                </button>
                <h2>Candidates Information</h2>
            </div>

            <table class="table">
                <thead>
                    <th>Candidate Name</th>
                    <th>Candidate Symbol</th>
                    <th>Symbol Image</th>
                    <th>Position</th>
                    <th>Total Votes</th>

                </thead>
                <tbody>
                    <?php

                    include "../includes/all-select-data.php";

                    while ($result = mysqli_fetch_assoc($can_data)) {
                        echo "<tr>
                        <td>" . $result['cname'] . "</td>
                        <td>" . $result['symbol'] . "</td>
                        <td><a href='$result[symphoto]'><img src='" . $result['symphoto'] . "'></a></td>
                        <td>" . $result['position'] . "</td>
                        <td>" . $result['tvotes'] . "</td>
                        
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Candidate</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="Add_candidate.php">
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Candidate Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="cname" >
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Candidate Position</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="position" >
                                </div>
                                <div class="form-group">
                                    <label for="symbol">Candidate Symbol</label>
                                    <input type="text" class="form-control" id="symbol" aria-describedby="emailHelp" name="symbol" >
                                    
                                </div>

                                <div class="form-group">
                                    <label for="image">Symbol Image</label>
                                    <input type="text" class="form-control" id="image" name="symphoto" >
                                </div>
                                
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        function delconfirm() {
            return confirm('Delete this Candidate?');
        }
    </script>
</body>

</html>