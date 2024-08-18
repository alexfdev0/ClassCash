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
          <a href="login_google.php" class="btn btn-secondary">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.6 10.2273C19.6 9.51819 19.5364 8.83637 19.4182 8.18182H10V12.05H15.3818C15.15 13.3 14.4455 14.3591 13.3864 15.0682V17.5773H16.6182C18.5091 15.8364 19.6 13.2727 19.6 10.2273Z" fill="#4285F4"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 20C12.7002 20 14.9638 19.1045 16.6184 17.5772L13.3866 15.0681C12.4911 15.6681 11.3457 16.0227 10.0002 16.0227C7.39566 16.0227 5.19111 14.2636 4.40475 11.9H1.06384V14.4909C2.7093 17.7591 6.09112 20 10.0002 20Z" fill="#34A853"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M4.40455 11.8999C4.20455 11.2999 4.09091 10.659 4.09091 9.99994C4.09091 9.34085 4.20455 8.69994 4.40455 8.09994V5.50903H1.06364C0.386364 6.85903 0 8.38631 0 9.99994C0 11.6136 0.386364 13.1409 1.06364 14.4909L4.40455 11.8999Z" fill="#FBBC05"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M10.0002 3.97727C11.4684 3.97727 12.7866 4.48182 13.8229 5.47273L16.6911 2.60455C14.9593 0.990909 12.6957 0 10.0002 0C6.09112 0 2.7093 2.24091 1.06384 5.50909L4.40475 8.1C5.19111 5.73636 7.39566 3.97727 10.0002 3.97727Z" fill="#EA4335"></path></svg>
            Login with Google
          </a><br><br>
          <button class="btn btn-primary" type="submit">Continue</button><br>
          <a class="btn btn-danger" href="home.php">Back</a><br>
        </div>
      </form>
    </center>
  </body>
</html>
