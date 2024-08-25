<?php
session_start();
require "requires/autoload.php";
$user_data = check_login($con);
$sid = $user_data['id'];

$classid = $_GET['sel'];
$rewardid = $_GET['rsel'];
$clink = "class_overview.php?sel=" . $classid;
$slink = "class_store.php?sel=" . $classid;
$plink = "purchase_reward.php?sel=" . $classid . "&rsel=" . $rewardid;

$rname = "";
$rdescr = "";
$rprice = 0;

$balance = 0;
$classname = "a";
$time = "";

$query = "select * from rewards where id='$rewardid'";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rname = $row['name'];
            $rdescr = $row['descr'];
            $rprice = $row['price'];
            $time = $row['time'];
        }
    }
}

$query2 = "select * from classes where id='$classid'";
$result2 = mysqli_query($con, $query2);
if ($result2) {
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $classname = $row['name'];
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
        require 'requires/navbar.php';
        ?>

        <h1>Rewards</h1><br>
        <h2><?php echo $rname; ?></h2><br>
        <h3>Overview</h3><br>
        Price: <?php echo $rprice; ?> ClassCoins<br>
        <h3>Description</h3><br>
        <?php echo $rdescr; ?><br><br>
        <div class="d-grid gap-2">
            <a class="btn btn-primary" href=<?php echo $plink; ?>>Purchase Reward</a><br>
            <a class="btn btn-danger" href=<?php echo $slink; ?>>Cancel</a>
        </div>

    </body>
</html>
