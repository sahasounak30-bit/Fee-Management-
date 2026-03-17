<?php
// session start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// db link fire
include_once __DIR__ . "/../../server/config/db.php";

if (isset($_POST["fee_entry"])) {

    $id = intval($_POST["id"]);
    $fee_amount = floatval($_POST["fee_amount"]);
    $recipt_date = $_POST["fee_date"];
    $status = "paid";
    $admin = $_SESSION["signIn"];

    if (empty($_POST["fee_date"])) {

        $_SESSION["err"][] = "Pleace Select Date";
        header("Location: /feeManager/client/views/page/feeEntry.php?student_id=" . $id);
        exit;

    }

    // check duplicate payment
    $check_sql = "SELECT id FROM fee_payments WHERE student_id=? AND payment_date=? ";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "is", $id, $recipt_date);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (!empty(mysqli_fetch_assoc($check_result))) {

        $_SESSION["err"][] = "This month's fee already paid.";
        header("Location: /feeManager/client/views/page/feeEntry.php?student_id=" . $id);
        exit;
    }

    // insert payment
    $sql = "INSERT INTO fee_payments 
            (student_id, amount_paid, payment_date, status, received_by)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "idssi", $id, $fee_amount, $recipt_date, $status, $admin);

    if (mysqli_stmt_execute($stmt)) {

        $_SESSION["success"][] = "Payment Successful";

    } else {

        $_SESSION["err"][] = "Payment Failed";
    }

    header("Location: /feeManager/client/views/page/feePage.php");
    exit;
}
?>