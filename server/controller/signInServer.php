<?php
// session start
session_start();

// database connection file link
include_once __DIR__ . "/../../server/config/db.php";

if (isset($_POST["signIn"])) {

    if (
        !empty(trim($_POST["username"])) &&
        !empty(trim($_POST["email"])) &&
        !empty(trim($_POST["pass"])) &&
        !empty(trim($_POST["qna"]))
    ) {

        // validation
        $adminName = trim($_POST["username"]);
        $adminEmail = trim($_POST["email"]);
        $adminPass = trim($_POST["pass"]);
        $adminQna = trim($_POST["qna"]);

        // sql search the admin 
        $sql = "SELECT * FROM admin WHERE admin_name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $adminName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);

        if (!empty($admin)) { // if admin is exist

            if ($admin["email"] == $adminEmail) { // if email is match 

                if (password_verify($adminPass, $admin["pass"])) { // if password is match

                    if ($admin["qna"] == $adminQna) {

                        $_SESSION["signIn"] = $admin["id"];
                        header("Location: /feeManager/client/views/page/home.php");
                        exit();

                    } else { // the admin qna not match

                        $_SESSION["err"][] = "incorrect qna";
                        header("Location: /feeManager/auth/signIn.php");
                        exit();

                    }

                } else { // the admin password not match

                    $_SESSION["err"][] = "incorrect password";
                    header("Location: /feeManager/auth/signIn.php");
                    exit();

                }

            } else { // the admin email not match

                $_SESSION["err"][] = "the admin email not match";
                header("Location: /feeManager/auth/signIn.php");
                exit();

            }

        } else { // the admin not found

            $_SESSION["err"][] = "the admin not found";
            header("Location: /feeManager/auth/signIn.php");
            exit();

        }

    } else { // all field requerd 

        $_SESSION["err"][] = "All fields are requerd";
        header("Location: /feeManager/auth/signIn.php");
        exit();

    }
}
?>