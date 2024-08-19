<?php
$APP_OPEN = false;
session_start();
require 'requires/autoload.php';
if ($APP_OPEN == false) {
    header("Location: index.html");
}
$user_data = check_login($con);

if ($user_data['educator'] == 0) {
    header("Location: home_student.php");
} else {
    header("Location: home_educator.php");
}
?>