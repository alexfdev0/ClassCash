<?php
session_start();
require 'requires/autoload.php';
$user_data = check_login($con);
$id = $user_data['id'];

$wtext = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $classcode = $_POST['classcode'];
    $classid = 0;
    $query = "select * from classes where classcode='$classcode'";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $classid = $row['classid'];
            }
        } else {
            $wtext = "We could not find a class with that code.";
        }
    }
    $query2 = "insert into class_entries (studentid, classid) values ('$id', '$classcode')";
    $result2 = mysqli_query($con, $query2);
    header("Location: home_student.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>ClassCash</title>
    </head>
    <style>
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
        }

        .card {
            background-color: #f8f8f8;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="home_student.php">ClassCash</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Me
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="join_class.php" class="nav-link"><span class="material-symbols-outlined">add</span> Join a Class</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <center>
            <h1>Join a Class</h1><br>
            Please enter the code on your teacher's screen to join.<br>
            <form method="submit">
                <input type="text" class="form-control" placeholder="Class Code" name="classcode"><br>
                <div style="color: #FF5959;"><?php echo $wtext; ?></div><br> 
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Join Class</button>
                </div>
            </form>
        </center>
    </body>
</html>
