<?php
session_start();
require "requires/autoload.php";
$user_data = check_login($con);
$sid = $user_data['id'];

if ($user_data['educator'] == 0) {
    echo "Unauthorized.";
    exit;
}

$classid = $_GET['sel'];

$classname = "a";

$query2 = "select * from classes where id='$classid'";
$result2 = mysqli_query($con, $query2);
if ($result2) {
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $classname = $row['name'];
            $owner = $row['owner'];
            if ($sid != $owner) {
                echo "Unauthorized.";
                exit;
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>ClassCash - Class Overview</title>
    </head>
    <body>
        <?php
        require 'requires/navbar_educator.php';
        ?>
        <h1>Unredeemed Rewards</h1><br><br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Reward Name</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">View Reward</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rval = 0;
                $query = "select * from inventory where classid='$classid' and redeemed='$rval'";
                $result = mysqli_query($con, $query);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $reid = $row['id'];
                            $rewid = $row['rewardid'];
                            $studentid = $row['studentid'];
                            $rewname = "";
                            
                            $query3 = "select * from rewards where id='$rewid'";
                            $result3 = mysqli_query($con, $query3);
                            if ($result3 && mysqli_num_rows($result3)) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $rewname = $row3['name'];
                                }
                            }

                            $fname = "";
                            $lname = "";
                            $rewviewlink = "class_inventory_view.php?sel=" . $classid . "&rsel=" . $reid;
                            $query2 = "select * from accounts where id='$studentid'";
                            $result2 = mysqli_query($con, $query2);
                            if ($result2) {
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        $fname = $row2["firstname"];
                                        $lname = $row2["lastname"];
                                    }
                                }
                            }
                            echo "
                            <tr>
                                <td>" . $rewname . "</td>
                                <td>" . $fname . "</td>
                                <td>" . $lname . "</td>
                                <td><a href=" . $rewviewlink . " class='btn btn-primary'>View Reward</a></td>
                            </tr>
                            ";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
</html>
