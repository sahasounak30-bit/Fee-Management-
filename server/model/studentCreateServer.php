<?php
// session start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// database connection file link
include_once __DIR__ . "/../../server/config/db.php";

if (isset($_POST["create_student"])) {


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

        // sql for finding studend is exist or not
        $sql = "SELECT id FROM students WHERE phone = ? AND dob = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $phone, $dob);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $student = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (empty($student)) { // student not exist create the student

            // sql for create student
            $sql = "INSERT INTO students (`first_name`, `last_name`, `phone`, `dob`, `gender`, `address`, `edu_qualification`, `admition_date`)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param(
                $stmt,
                "ssssssss",
                $first_name,
                $last_name,
                $phone,
                $dob,
                $gender,
                $address,
                $edu_qualification,
                $admition_date
            );
            $result = mysqli_stmt_execute($stmt);

            if (!empty($result)) { // success message

                $_SESSION["success"] = "student creation successfully";
                header("Location: /feeManager/client/views/page/studentFetch.php");
                exit();

            } else { // Somthing is wrong

                $_SESSION["err"][] = "Somthing is wrong";
                header("Location: /feeManager/client/views/page/studentCreate.php");
                exit();

            }

        } else { // else student is exist show the err

            $_SESSION["err"][] = "the student is already exist";
            header("Location: /feeManager/client/views/page/studentCreate.php");
            exit();

        }

    } else {

        $_SESSION["err"][] = "all fields are requerd";
        header("Location: /feeManager/client/views/page/studentCreate.php");
        exit();

    }
}
?>