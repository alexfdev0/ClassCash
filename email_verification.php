<?php
session_start();
require "requires/autoload.php";

if (!isset($_SESSION['logon_email'])) {
  exit;
}

$MAIL = false;

$email = $_SESSION['logon_email'];
if (!isset($_SESSION['lcode'])) {
  $code = rand(100000, 999999);
  $scode = strval($code);
  $_SESSION['lcode'] = $scode;
  $MAIL = true;
}

$from = "service@classcash.xyz";
$to = $email;
$subject = "ClassCash Verification Code";
$headers = "From: " . $from . "\r\nContent-Type: text/html; charset=ISO-8859-1\r\nMIME-Version: 1.0\r\n";
$body = "
<html>
  <body>
    <p style='font-family:verdana'>
      <h1>Class<span style='color: #90EE90'>Cash</span></h1><br><br>
      Because someone was trying to log into your account, we need to verify it's really you.<br>
      Your one time verification code is " . $code .".<br>
      Do NOT share this code with anybody. ClassCash will never ask for this code.<br>
      If you did not request this code, you may safely ignore this email.<br>
      Thank you for using ClassCash.<br>
    </p>
  </body>
</html>
";

if ($MAIL == true) {
  mail($to, $subject, $body, $headers);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $ucode = $_POST['code'];

  if ($ucode == $_SESSION['lcode']) {
    $query = "select * from accounts where email='$email'";
    $result = mysqli_query($con, $query);
    if ($result) {
     if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $studentid = $row['id'];
          $_SESSION['id'] = $studentid;
          header("Location: index.php");
        }
     }
    }
  } else {
    echo "<script>alert('The code you entered was incorrect. Please check your code and try again. You put ". $ucode ." but " . $scode . " was right.')</script>";
  }
}

?>

<html>
  <head>
    <title>ClassCash - Complete Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <center>
      <h1>Account Verification</h1><br><br>
      Please enter the one time code we have sent to your email to log into your ClassCash account.<br><br>
      <form method="post">
        <input class="form-control" type="code" name="code" placeholder="6-digit verification code"><br><br>
        <div class="d-grid gap-2">
          <button class="btn btn-primary" type="submit">Login</button><br><br>
        </div>
      </form>  
    </center>
  </body>
</html>
