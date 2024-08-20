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
$inventoryid = $_GET['rsel'];

$classname = "a";

$rname = "";
$rdescr = "";
$rowner = 0;
$rprice = 0;
$rowner_fname = "";
$rowner_lname = "";
$time = "";

$rewardid = 0;

$query0 = "select * from inventory where id='$inventoryid'";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rewardid = $row['rewardid'];
            $rowner = $row['studentid'];
            $time = $row['time'];
        }
    }
}

$query = "select * from rewards where id='$rewardid'";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rname = $row['name'];
            $rdescr = $row['descr'];
            $rprice = $row['price'];
        }
    }
}

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

$query3 = "select * from accounts where id='$rowner'";
$result3 = mysqli_query($con, $query3);
if ($result3) {
    if (mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_assoc($result3)) {
            $rowner_fname = $row['firstname'];
            $rowner_lname = $row['lastname'];
        }
    }
}

$link = "redeem_reward.php?sel=" . $classid . "&rsel=" . $rewardid;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $val = 1;
    $query = "update inventory set redeemed='$VAL' where id='$inventoryid'";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location: " . $cilink);
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
    <style>
        .profile-picture-container {
            width: 150px;
            height: 150px;
            overflow: hidden;
            border-radius: 50%;
        }

        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>
    <body>
        <?php
        require 'requires/navbar_educator.php';
        ?>
        <h1>Reward Details</h1><br>
        <h2><?php echo $rname; ?></h2><br>
        <h3>Overview</h3><br>
        Price: <?php echo $rprice; ?> ClassCoins<br>
        Owner: <?php echo $rowner_fname . " " . $rowner_lname; ?><br>
        Time purchased: <?php echo $time; ?><br>
        <h2>Actions</h2><br>
            <div class="d-grid gap-2">
                <a href=<?php echo $link; ?>  class="btn btn-danger">Mark as redeemed</a>
            </div>
    </body>
</html>
