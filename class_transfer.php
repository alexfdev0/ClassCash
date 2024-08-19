<?php
session_start();
require "requires/autoload.php";
$user_data = check_login($con);
$sid = $user_data['id'];

$classid = $_GET['sel'];


$balance = 0;
$classname = "a";
$tfr_enabled = 0;

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
            $tfr_enabled = $row['tfrenabled'];
        }
    }
}

if ($tfr_enabled == 0) {
  header("Location: transfer_disabled.php?sel=" . $classid);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $recipient = $_POST['email'];
    $amt = $_POST['classcoins'];

    $query = "select * from accounts where email='$recipient' limit 1";
    $result = mysqli_query($con, $query)
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            if ($balance >= $amt) {
                $recipid = 0;
                $recipbal = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $recipid = $row['id'];
                }
                $query = "select * from balances where studentid='$recipid' and classid='$classid'";
                $result = mysqli_query($con, $query);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $newBalance = $balance - $amt;
                        $query2 = "update balances set balance='$newBalance' where studentid='$sid' and classid='$classid'";
                        $result2 = mysqli_query($con, $query2);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $recipbal = $row['balance'];
                            $amtafter = $recipbal + $amt;
                            $query = "update balances set balance='$amtafter' where studentid='$recipid' and classid='$classid'";
                            $result = mysqli_query($con, $query);
                            header("Location: transfer_successful.php?sel=" . $classid);
                        }
                    }else{
                        echo "<script>alert('Transfer failure: User does not exist within this class..')</script>";
                    }
                }
            }else{
                echo "<script>alert('Transfer failure: Insufficient funds.')</script>";
            }
        }else{
            echo "<script>alert('Transfer failure: User with that email does not exist.')</script>";
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
        //require 'requires/navbar.php';
        ?>

        <h1>Transfer ClassCoins</h1><br><br>

        <form method="post">
            <input type="email" name="email" class="form-control" placeholder="Recipient Email Address"><br><br>
            <input type="text" name="classcoins" class="form-control" placeholder="ClassCoins to Send"><br><br>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Send ClassCoins</button>
                <a href=<?php echo $plink; ?> class="btn btn-primary">Back to Overview</a>
            </div>
        </form>
    </body>
</html>
