<?php
include_once __DIR__ . "/../server/controller/devServer.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev Page</title>
</head>

<body>

    <?php
    if (!empty($_SESSION["err"])) {
        foreach ($_SESSION["err"] as $err) {
            echo $err;
        }
        unset($_SESSION["err"]);
    }
    ?>
    <h1>Dev</h1>
    <form action="/feeManager/server/controller/devServer.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="pass" placeholder="Password">
        <input type="text" name="qna" placeholder="QNA">
        <button type="submit" name="createUser">Create User</button>
    </form>
</body>

</html>