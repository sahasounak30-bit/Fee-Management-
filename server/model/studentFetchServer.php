<?php
// database connection file link
include_once __DIR__ . "/../../server/config/db.php";

// sql for fetch all students
$sql = "SELECT *
        FROM students";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = [];

if (!empty($result)) {

    while ($student = mysqli_fetch_assoc($result)) {
        $row[] = $student;
    }

} else {

    $err = "No Student Created";

}
?>