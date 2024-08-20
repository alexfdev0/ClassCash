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
$rewardid = $_GET['rsel'];

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
$rval = 1;
$query3 = "update rewards set redeemed='$rval' where id='$rewardid'";
$result3 = mysqli_query($con, $query3);

if ($result3) {
    header("Location: class_inventory.php?sel=" . $classid);
}
?>