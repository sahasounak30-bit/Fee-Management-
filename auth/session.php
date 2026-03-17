<?php
// session_start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION["signIn"])) {

    header("Location: /feeManager/auth/signIn.php");
    exit;

}
?>