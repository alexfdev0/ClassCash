<?php

$host = "127.0.0.1";
$user = "u_";
$pass = "ClassCash";
$name = "u_";

$con = mysqli_connect($host, $user, $pass, $name);

if (!con) {
  die("Failed to connect to ClassCash servers. Please try again later.");
}

?>
