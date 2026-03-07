<?php
session_start();
// session_start

if (empty($_SESSION["signIn"])) {

    header("Location: /feeManager/auth/signIn.php");
    exit;

} else {

    header("Location: /feeManager/client/views/page/home.php");
    exit;

}
?>