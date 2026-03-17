<?php
// session start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// database connection file link
include_once __DIR__ . "/../../server/config/db.php";

if (isset($_POST["deleteBtn"])) {

    // validation
    if (!empty($_POST["id"])) {

        $id = $_POST["id"];

        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $student = mysqli_fetch_assoc($result);

        if (empty($student)) {

            $_SESSION["err"] = "the student is not there";
            header("Location: /feeManager/client/views/page/studentFetch.php");
            exit;

        }

        $del = $conn->prepare("DELETE FROM students WHERE id = ?");
        $del->bind_param("i", $id);
        $del->execute();

        $_SESSION["success"] = "Student {$student['first_name']} {$student['last_name']} has been deleted";
        header("Location: /feeManager/client/views/page/studentFetch.php");
        exit;

    }
}
?>