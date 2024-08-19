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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="home_student.php">ClassCash</a>
                <div class="navbar-brand"><?php echo $classname; ?></div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href=<?php echo $clink; ?> class="nav-link"><span class="material-symbols-outlined">account_circle</span> Class Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href=<?php echo $slink; ?> class="nav-link"><span class="material-symbols-outlined">store</span> Shop</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Me
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><br>

        <h1>Rewards</h1><br><br>
        <h2><?php echo $rname; ?></h2><br>
        <h3>Overview</h3><br>
        Price: <?php echo $rprice; ?><br><br>
        <h3>Description</h3><br>
        <?php echo $rdescr; ?>

    </body>
</html>