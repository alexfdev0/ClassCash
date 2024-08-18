<?php
session_start();
//require("requires/autoload.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $email = $_POST['email'];
  $domain = substr(strrchr($email, "@"), 1);

  if ($domain != "woodward.edu") {
    header("Location: unsupported_school.php");
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
  <body>
    <center>
      <h2>Sign into ClassCash</h2><br><br>
      Please enter your email address below.<br><br>
      <form method="post">
        <input class="form-control" type="email" name="email" placeholder="Email Address" required><br><br>
        <div class="d-grid gap-2">
          <button class="btn btn-primary" type="submit">Continue</button><br><br>
        </div>
      </form>
    </center>
  </body>
</html>
