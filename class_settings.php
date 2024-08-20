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
$classdescr = "";
$tfrenabled = 0;

$query2 = "select * from classes where id='$classid'";
$result2 = mysqli_query($con, $query2);
if ($result2) {
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $classname = $row['name'];
            $classdescr = $row['descr'];
            $owner = $row['owner'];
            $tfrenabled = $row['tfrenabled'];
            if ($sid != $owner) {
                echo "Unauthorized.";
                exit;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $cname = $_POST['class_name'];
    $cdesc = $_POST['class_descr'];
    $tfrs = $_POST['tfrs'];
    $tfrsenabled = 0;
    if (isset($_POST['tfrs'])) {
        $tfrsenabled = 1;
    }
    if ($cname != "" && $cname != $classname) {
        $query = "update classes set name='$cname' where id='$classid'";
        $result = mysqli_query($con, $query);
    }
    if ($cdesc != "" && $cname != $classname) {
        $query = "update classes set descr='$cdesc' where id='$classid'";
        $result = mysqli_query($con, $query);
    }
    $query = "update classes set tfrenabled='$tfrsenabled' where id='$classid'";
    $result = mysqli_query($con, $query);
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
        <h1>Settings</h1><br><br>
        <h4>Class Information</h4><br>
        <form method="post">
            <input name="class_name" class="form-control" placeholder="Class Name" value=<?php echo $classname; ?>><br><br>
            <textarea name="class_descr" class="form-control" rows="3" placeholder="Class Description" value=<?php echo $classdescr; ?>></textarea><br><br>
            <h4>Class Settings</h4><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="tfrs" id="enableTransfers" <?php if ($tfrenabled == 1) { echo "checked"; }?>>
                <label class="form-check-label" for="enableTransfers">
                    Allow students to send and recieve ClassCoins from eachother.
                </label>
            </div><br><br>
            <button type="submit" class="btn btn-primary">Save Settings</button><br><br>
        </form>
        <a href="create_reward.php" class="btn btn-primary">Create a reward</a><br><br>
        <a href="create_voucher.php" class="btn btn-primary">Create a voucher</a>
    </body>
</html>
