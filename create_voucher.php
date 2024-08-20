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
    $name = $_POST['reward_name'];
    $descr = $_POST['reward_descr'];
    $points = $_POST['points'];
    $query = "insert into voucher (name, descr, class, points) values ('$name', '$descr', '$classid', '$points')";
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
        <h1>Create Voucher</h1><br><br>
        <form method="post">
            <input name="reward_name" class="form-control" placeholder="Reward Name"><br><br>
            <textarea name="reward_descr" class="form-control" rows="3" placeholder="Reward Description"></textarea><br><br>
            <input name="points" class="form-control" placeholder="Point Cost"><br><br>
            <button type="submit" class="btn btn-primary">Create Reward</button>
        </form>
        <a href=<?php echo $selink; ?> class="btn btn-danger">Back</a><br><br>
    </body>
</html>
