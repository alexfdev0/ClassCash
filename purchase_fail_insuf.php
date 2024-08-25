<?php
session_start();
require "requires/autoload.php";
$user_data = check_login($con);
$sid = $user_data['id'];

$classid = $_GET['sel'];
$rewardid = $_GET['rsel'];
$clink = "class_overview.php?sel=" . $classid;
$slink = "class_store.php?sel=" . $classid;

$rname = "";
$rdescr = "";
$rprice = 0;

$balance = 0;
$classname = "a";

$query = "select * from rewards where id='$rewardid'";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
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
        }
    }
}

$diff = $rprice - $balance;
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
        <h1>Purchase failure</h1><br><br>
        Sorry, but your purchase could not be completed because you do not have enough ClassCoins.<br>
        You need <?php echo $diff; ?> more ClassCoins to complete this transaction.<br>
        You may get some by earning rewards or transferring ClassCoins with other students if your teacher has it enabled.<br>
        <div class="d-grid gap-2">
          <a href=<?php echo $slink; ?> class="btn btn-primary">Back to shop</a>
        </div>
      </center>

    </body>
</html>
