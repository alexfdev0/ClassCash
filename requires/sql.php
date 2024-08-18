<?php
define('DB_HOST', '127.0.0.1');
define('DB_USERNAME', 'u878558493_cc');
define('DB_PASSWORD', 'AlexFlaxIsCool1!');
define('DB_NAME', 'u878558493_classcash');
$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$con) {
  die("Failure connecting to ClassCash servers.");
}
  
?>
