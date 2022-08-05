<?php
session_start();
$names = $_SESSION['name'];
$info = $_SESSION['info'];
$email = $_SESSION['email'];
$picture = $_SESSION['picture'];
$userinfo = $_SESSION['userinfo'];

if (!isset($_SESSION["auth"])) {

    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?php echo $names ?> </h1>
    <h1><?php echo $email ?> </h1>
    <h1><?php echo $userinfo['email'] ?> </h1>
    <img src=$picture alt="">
    <a href="logout.php">Logout</a>
</body>

</html>