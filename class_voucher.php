<?php
session_start();
require "requires/autoload.php";
$user_data = check_login($con);
$sid = $user_data['id'];

$classid = $_GET['sel'];


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
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 40px;
            padding: 20px;
        }

        .card {
            background-color: #f8f8f8;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
    <body>
        <?php
        require 'requires/navbar_educator.php';
        ?>

        <h1>Choose Voucher</h1><br><br>

        <div class="card-container">
            <?php
                    $query = "select * from voucher where class = '$classid'";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $name = $row['name'];
                                $price = $row['points'];

                                $vlink = "class_voucher_give.php?sel=" . $classid . "&vsel=" . $id;
                                echo "
                                <div class='card' style='width: 15rem;'>
                                    <img src='image.jpg' class='card-img-top' alt='...'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>" . $name . "</h5>
                                        <p class='card-text'>Points: " . $price . " ClassCoins<br>
                                        <a href=" . $vlink ." class='btn btn-primary'>View</a>
                                    </div>
                                </div>
                                ";
                            }
                        }
                    }
            ?>
        </div>
    </body>
</html>
