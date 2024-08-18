<?php
session_start();
require 'requires/autoload.php';
$user_data = check_login($con);
$id = $user_data['id'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>ClassCash</title>
    </head>
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
                    </ul>
                </div>
            </div>
        </nav>

        <h1>Hello, <strong><?php echo $user_data['firstname']; ?></strong>!</h1><br><br>
        <h2>My Classes</h2>
        <div class="container">
                <?php
                    $query = "select * from class_entries where studentid = '$id'";
                    $result = mysqli_query($con, $query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $classid = $row['classid'];
                                $clink = "class_overview?sel='$classid'";
                                echo "
                                <div class='col-md-4'>
                                    <div class='card'>
                                        <img src='image.jpg' class='card-img-top' alt='...'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>PLACEHOLDER</h5>
                                            <p class='card-text'>EXAMPLE TEXT</p>
                                            <a href=" . $clink ." class='btn btn-primary'>Go to class</a>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        }
                    }
                ?>
        </div>
    </body>
</html>