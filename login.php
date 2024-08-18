<?php
session_start();
require "requires/autoload.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $email = $_POST['email'];
  $domain = substr(strrchr($email, "@"), 1);

  if ($domain != "woodward.edu") {
    header("Location: unsupported_school.php");
    die;
  }

  $query = "select * from accounts where email='$email' limit 1";
  $result = mysqli_query($con, $query);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['logon_email'] = $email;
      header("Location: email_verification.php");
    } else {
      $_SESSION['logon_email'] = $email;
      header("Location: manual_signup.php");
    }
  } else {
    echo "<script>alert('Failed to fetch data from server. Please try again later.')</script>";
  }
  
}
?>
<html>
  <head>
    <title>ClassCash - Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <style>
        .google-btn {
            display: inline-block;
            background: white;
            color: #444;
            border-radius: 4px;
            border: 1px solid #888;
            white-space: nowrap;
            padding: 8px 12px;
            box-shadow: 1px 1px 2px #aaa;
            font-size: 16px;
            font-family: Roboto, arial, sans-serif;
            cursor: pointer;
        }

        .google-btn img {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            vertical-align: middle;
        }

      .google-btn:hover {
          box-shadow: 1px 1px 3px #888;
      }
  </style>
  <body>
    <center>
      <h2>Sign into ClassCash</h2><br><br>
      Please enter your email address below.<br><br>
      <form method="post">
        <input class="form-control" type="email" name="email" placeholder="Email Address" required><br><br>
        or <br><br>
        <div class="d-grid gap-2">
          <a href="login_google.php" class="google-btn">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" alt="Google Logo">
            Login with Google
          </a><br>
          <button class="btn btn-primary" type="submit">Continue</button><br>
          <a class="btn btn-danger" href="home.php">Back</a><br>
        </div>
      </form>
    </center>
  </body>
</html>
