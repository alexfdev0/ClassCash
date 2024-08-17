<?php
session_start();
?>
<html>
  <head>
    <title>ClassCash - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <center>
      <h2>Sign into ClassCash</h2><br><br>
      Please enter your email address below.
      <form method="post">
        <input class="form-control" type="email" name="email" placeholder="Email Address" required><br><br>
        <div class="d-grid gap-2">
          <button class="btn btn-primary" type="submit">Continue</button><br><br>
        </div>
      </form>
    </center>
  </body>
</html>
