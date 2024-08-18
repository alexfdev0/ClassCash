<?php
session_start();
require 'requires/autoload.php';

if (!isset($_SESSION['id'])) {
    unset($_SESSION['id']);
}

header("Location: home.php");