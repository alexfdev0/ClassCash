<?php
session_start();
require 'requires/autoload.php';
$user_data = check_login($con);

if ($user_data['educator'] == 0) {
    header("Location: home_student.php");
} else {
    header("Location: home_educator.php");
}
?>