<?php
session_start();
require "requires/autoload.php";

if (!isset($_SESSION['logon_email'])) {
    header("Location: login.php");
    exit;
}
$email = $_SESSION['logon_email'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $query = "insert into accounts (firstname, lastname, email) values ('$fname', '$lname', '$email')";
    $result = mysqli_query($con, $query);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>ClassCash - Signup</title>
    </head>
    <body>
        <center>
            <h1>Complete Signup</h1><br><br>
            Please complete the signup process.<br><br>
            <form method="post">
                <input type="name" name="fname" placeholder="First Name" required><br><br>
                <input type="name" name="lname" placeholder="Last Name" required><br><br>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Complete</button>
                </div>
            </form>
        </center>
    </body>
</html>