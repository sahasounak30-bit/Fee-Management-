<?php
include_once __DIR__ . "../server/controller/signInServer.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
</head>

<body>
    <h1>Error Page</h1>
    <?php if (!empty($_SESSION["signIn"])){?>
    <a href="/feeManager/client/views/page/feeEntry.php">Fee Entry</a>
    <?php } else {?>
    <a href="/feeManager/auth/signIn.php">Go to SignIn Page</a>
    <?php } ?>

</body>

</html>