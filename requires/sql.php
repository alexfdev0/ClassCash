<?php

$host = "127.0.0.1";
$user = "u_878558493_classcash";
$pass = "AlexTheFemboy0";
$name = "u_878558493_classCash";

$con = mysqli_connect($host, $user, $pass, $name);

if (!con) {
  die("Failed to connect to ClassCash servers. Please try again later.");
}

?>
