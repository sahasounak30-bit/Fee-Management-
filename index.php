<?php
include_once "./server/config/db.php";
include_once __DIR__ . "../server/controller/signInServer.php";

if (!empty($_SESSION["signIn"])) {

    header("Location: /feeManager/client/views/page/home.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
</head>

<body>
    <h1>Welcome Page</h1>
    <a href="/feeManager/auth/signIn.php">Sign in</a>
    <a href="/feeManager/auth/dev.php">Dev</a>
</body>

</html>