<?php
require_once 'vendor/autoload.php';

session_start();

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri("https://classcash.xyz/callback.php");
$client->addScope("email");
$client->addScope("profile");

$authUrl = $client->createAuthUrl();

header("Location: " . filter_var($authUrl, FILTER_SANITIZE_URL));
exit;
?>