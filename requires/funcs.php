<?php
function check_login($con) {
  if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $query = "select * from accounts where customerid = '$id' limit 1";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);
      if ($user_data['isbanned'] == 1) {
        header("Location: account_suspended.php");
        die;
      }
      $_SESSION['isloggedin'] = true;
      return $user_data;
    }
  }else{
    header("Location: http://fayettevillegreen.com/home.php");
  }
}
?>
