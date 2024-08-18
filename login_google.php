<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('291381949727-uq2aqmee6jcplkclu58plobkumgfjfqn.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri("https://classcash.xyz/callback.php");
$client->addScope("email");
$client->addScope("profile");

$authUrl = $client->createAuthUrl();

header("Location: " . filter_var($authUrl, FILTER_SANITIZE_URL));
exit;
?>