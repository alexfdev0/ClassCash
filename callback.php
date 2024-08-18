<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId('291381949727-uq2aqmee6jcplkclu58plobkumgfjfqn.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri("https://classcash.xyz/callback.php");
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    $firstName = $userInfo->givenName;
    $lastName = $userInfo->familyName;
    $email = $userInfo->email;

    $query = "select * from accounts where email='$email' limit 1";
    $result = mysqli_query($con, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $_SESSION['id'] = $id;
                header("Location: index.php");
            }
        } else {
            $query = "insert into accounts (firstname, lastname, email) values ('$firstName', '$lastName', '$email')";
            $result = mysqli_query($con, $query);

            $query = "select * from accounts where email='$email' limit 1";
            $result = mysqli_query($con, $query);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $_SESSION['id'] = $id;
                        header("Location: index.php");
                    }
                }
            }
        }
    } 
} else {
    echo "Unauthorized. Looping you back now.";
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>ClassCash - Just a Moment</title>
    </head>
    <body>
        <div class="d-flex justify-content-center">
            <strong>Hold on one moment...</strong>
        </div>
    </body>
</html>