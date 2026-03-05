<?php
// session start
session_start();

// database connection file link
include_once __DIR__ . "/../../server/config/db.php";

if (isset($_POST["createUser"])) {

    if (
        !empty(trim($_POST["username"])) &&
        !empty(trim($_POST["email"])) &&
        !empty(trim($_POST["pass"])) &&
        !empty(trim($_POST["qna"]))
    ) {

        // validation
        $adminName = trim($_POST["username"]);
        $adminEmail = trim($_POST["email"]);
        $adminPass = password_hash(trim($_POST["pass"]), PASSWORD_DEFAULT);
        $adminQna = trim($_POST["qna"]);

        // sql for checking email is exist or not    
        $sql = "SELECT * FROM admin WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $adminEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);

        if (empty($admin)) { // create admin 

            // sql for create admin
            $sql = "INSERT INTO admin (`admin_name`,`email`,`pass`,`qna`)
                                VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $adminName, $adminEmail, $adminPass, $adminQna);
            $result = mysqli_stmt_execute($stmt);

            if (!empty($result)) { // success message

                $_SESSION["success"] = "The Admin created Successfully";
                header("Location: /feeManager/auth/signIn.php");
                exit();

            } else {

                $_SESSION["err"][] = "something is wrong";
                header("Location: /feeManager/auth/dev.php");
                exit();

            }

        } else { // email already exist

            $_SESSION["err"][] = "The email is already exist";
            header("Location: /feeManager/auth/dev.php");
            exit();

        }

    } else { // all field requerd 

        $_SESSION["err"][] = "All fields are requerd";
        header("Location: /feeManager/auth/dev.php");
        exit();

    }
}
?>