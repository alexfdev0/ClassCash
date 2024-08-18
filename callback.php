<?php
require_once 'vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setClientId(getenv('GOOGLE_CLIENT_ID'));
$client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
$client->setRedirectUri("https://classcash.xyz/callback.php");
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    try {
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
    } catch (Exception $e) {
        echo "Error! " . $e->getMessage();
    }
} else {
    echo "Unauthorized. Looping you back now.";
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}
?>