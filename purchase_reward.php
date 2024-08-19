<?php
session_start();
require "requires/autoload.php";
$user_data = check_login($con);
$sid = $user_data['id'];

$classid = $_GET['sel'];
$rewardid = $_GET['rsel'];

$clink = "class_overview.php?sel=" . $classid;
$slink = "class_store.php?sel=" . $classid;

$pfail = "purchase_fail_insuf.php?sel=" . $classid . "&rsel=" . $rewardid;
$psuc = "purchase_comp.php?sel=" . $classid . "&rsel=" . $rewardid;

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

$rid = 0;
$rprice = 0;

$query = "select * from rewards where id='$rewardid'";
$result = mysqli_query($con, $query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rid = $row['id'];
            $rprice = $row['price'];
        }
    }
}

if ($balance >= $rprice) {
    $newbalance = $balance - $rprice;
    $query = "insert into inventory (rewardid, studentid) values ('$rid', '$sid')";
    $result = mysqli_query($con, $query);
    $query = "update balances set balance='$newbalance' where studentid='$sid' and classid='$classid'";
    $result = mysqli_query($con, $query);
    header("Location: " . $psuc);
}else{
    header("Location: " . $pfail);
}

?>
