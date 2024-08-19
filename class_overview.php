<?php
session_start();
require "requires/autoload.php";
$user_data = check_login($con);
$sid = $user_data['id'];

$classid = $_GET['sel'];
$clink = "class_overview.php?sel=" . $classid;
$slink = "class_store.php?sel=" . $classid;
$tlink = "class_exchange.php?sel=" . $classid;

$balance = 0;
$classname = "a";

$query = "select * from balances where studentid='$sid' and classid='$classid'";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $balance = $row['balance'];
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

        <center>
            <div class="profile-picture-container">
                <img src="pictures/stock.webp" alt="Profile Picture" class="profile-picture">
            </div><br><br>
            <h2><?php echo $user_data['firstname'] . $user_data['lastname'] ?></h2><br>
            <h3><?php echo $balance; ?> ClassCoins</h3><br>
        </center>

    </body>
</html>
