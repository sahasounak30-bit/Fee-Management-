<?php
$dbhost = "localhost";
$dbroot = "root";
$dbpass = "";
$dbname = "fee_manager";

$conn = mysqli_connect($dbhost, $dbroot, $dbpass, $dbname);

if(!$conn){
    die("Database not connected" . mysqli_connect_error());
}
?>