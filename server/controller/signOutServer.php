<?php
// session start
session_start();

// session unset
$_SESSION[] = "";

// session destroy
session_destroy();

// redirect to signIn page
header("Location: /feeManager/auth/signIn.php");
exit();

?>