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
$code = 0;

$classname = "a";

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

$link = "https://classcash.xyz/join_class.php?classid=" . $classid;

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
        <center>
            <h1>ClassCash Join Link</h1><br><br>
            <h2>Go to<br><br><strong><?php echo $link; ?></strong><br><br> to join this class.</h2>
        </center>
    </body>
</html>
