<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// database connection file link
include_once __DIR__ . "/../../server/config/db.php";

if (isset($_POST["updateBtn"])) {

    $id = $_POST["id"];

    $sql = "SELECT * FROM `students` WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $_SESSION["student"] = [];

    while ($row = mysqli_fetch_assoc($result)) {

        $_SESSION["student"] = $row;

    }

    header("Location: /feeManager/client/views/page/studentUpdate.php");
    exit;
}

// update the student
if (isset($_POST["update_student"])) {

    if (
        !empty(trim($_POST["first_name"])) &&
        !empty(trim($_POST["last_name"])) &&
        !empty(trim($_POST["phone"])) &&
        !empty(trim($_POST["dob"])) &&
        !empty(trim($_POST["gender"])) &&
        !empty(trim($_POST["edu_qualification"])) &&
        !empty(trim($_POST["address"])) &&
        !empty(trim($_POST["admition_date"]))
    ) {

        // validation
        $first_name = trim($_POST["first_name"]);
        $last_name = trim($_POST["last_name"]);
        $phone = trim($_POST["phone"]);
        $dob = trim($_POST["dob"]);
        $gender = trim($_POST["gender"]);
        $edu_qualification = trim($_POST["edu_qualification"]);
        $address = trim($_POST["address"] ?? "");
        $admition_date = trim($_POST["admition_date"]);

        $id = $_POST["id"];

        // sql for update the student and display
        $sql = "UPDATE students
                SET `first_name` = ?, `last_name` = ?, `phone` = ?, `dob` = ?, `gender` = ?, `address` = ?, `edu_qualification` = ?, `admition_date` = ?
                WHERE `id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssssi",
            $first_name,
            $last_name,
            $phone,
            $dob,
            $gender,
            $address,
            $edu_qualification,
            $admition_date,
            $id
        );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //success message
        $_SESSION["success"] = "Student {$student["first_name"]} {$student["last_name"]} update to {$first_name} {$last_name}";
        header("Location: /feeManager/client/views/page/studentFetch.php");
        exit;

    } else {

        $_SESSION["err"][] = "all fields are requerd";
        header("Location: /feeManager/client/views/page/studentUpdate.php");
        exit;

    }
}

?>