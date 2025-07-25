<?php
require_once 'vendor/autoload.php';

session_start();

require 'requires/autoload.php';

$client = new Google_Client();
$client->setClientId(getenv('GOOGLE_CLIENT_ID'));
$client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
$client->setRedirectUri("https://classcash.xyz/callback_educator.php");
$client->addScope("email");
$client->addScope("profile");

$authUrl = $client->createAuthUrl();

header("Location: " . filter_var($authUrl, FILTER_SANITIZE_URL));
exit;
?>