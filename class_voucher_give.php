<?php
session_start();
require "requires/autoload.php";
$user_data = check_login($con);
$sid = $user_data['id'];

$classid = $_GET['sel'];
$rewardid = $_GET['vsel'];

$rname = "";
$rdescr = "";
$rprice = 0;

$balance = 0;
$classname = "a";
$time = "";

$query = "select * from voucher where id='$rewardid'";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rname = $row['name'];
            $rdescr = $row['descr'];
            $rprice = $row['points'];
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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['studentemail'];
    $query = "select * from accounts where email='$email'";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $stuid = $row['id'];
                $query2 = "select * from class_entries where studentid='$stuid' and classid='$classid'";
                $result2 = mysqli_query($con, $query2);
                if ($result2) {
                    if (mysqli_num_rows($result2) > 0) {
                        $query3 = "select * from balances where studentid='$stuid' and classid='$classid'";
                        $result3 = mysqli_query($con, $query3);
                        if ($result3) {
                            if (mysqli_num_rows($result3) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result3)) {
                                    $balance2 = $row2['balance'];
                                    $newbalance = $balance2 + $rprice;
                                    $query4 = "update balances set balance='$newbalance' where studentid='$stuid' and classid='$classid'";
                                    $result4 = mysqli_query($con, $query4);
                                    if ($result4) {
                                        header("Location: class_voucher_success.php?sel=" . $classid);
                                    }
                                }
                            }
                        }
                    } else {
                        echo "<script>alert('Voucher give failure: Student is not in this class.')</script>";
                    }
                }
            }
        } else {
            echo "<script>alert('Voucher give failure: Student does not exist.')</script>";
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

        <h1>Voucher</h1><br>
        <h2><?php echo $rname; ?></h2><br>
        <h3>Overview</h3><br>
        Point Reward: <?php echo $rprice; ?> ClassCoins<br>
        <h3>Description</h3><br>
        <?php echo $rdescr; ?><br><br>
        <form method="post">
            <input name="studentemail" class="form-control" placeholder="Student's email"><br><br>
            <button type="submit" class="btn btn-primary">Send Voucher</button><br><br><br>
        </form>
        <div class="d-grid gap-2">
            <a class="btn btn-danger" href=<?php echo $clink; ?>>Cancel</a>
        </div>
    </body>
</html>
