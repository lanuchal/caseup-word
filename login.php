<?php

use Google\Service\AlertCenter\Resource\Alerts;

require_once 'auth-google/vendor/autoload.php';
session_start();

if (isset($_SESSION["auth"])) {
    header("location: secret.php");
    exit;
}

$clientID = '986516252132-asfe780fjrfv35dhn5gjonkqf7cd4b78.apps.googleusercontent.com';
$clientSecret = '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';
$clientRedirectUri = 'http://localhost/caseupWord/login.php';

$client = new Google\Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($clientRedirectUri);
$client->addScope("email");
$client->addScope("profile");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <?php
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        $oauth = new Google\Service\Oauth2($client);
        $google_account_info = $oauth->userinfo->get();
        //Datenbank
        $userinfo = [
            'email' => $google_account_info['email'],
            'first_name' => $google_account_info['givenName'],
            'last_name' => $google_account_info['familyName'],
            'gender' => $google_account_info['gender'],
            'full_name' => $google_account_info['name'],
            'picture' => $google_account_info['picture'],
            'verifiedEmail' => $google_account_info['verifiedEmail'],
            'token' => $google_account_info['id'],
        ];

        $_SESSION['userinfo'] = $userinfo;
        $_SESSION['auth'] = true;
        echo 'data user';
        echo $userinfo['email']."<br>";
        echo $userinfo['first_name']."<br>";
        echo $userinfo['last_name']."<br>";
        echo $userinfo['gender']."<br>";
        echo $userinfo['full_name']."<br>";
        echo $userinfo['picture']."<br>";
        echo $userinfo['verifiedEmail']."<br>";
        echo $userinfo['token']."<br>";
        echo '<a href="logout.php">Logout</a>';
    
        // header("location: secret.php");
    } else {
        echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
    }

    ?>
</body>

</html>