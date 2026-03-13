<?php
// db link fire
include_once __DIR__ . "/../../../server/config/db.php";
// fee create file link
include_once __DIR__ . "/../../../server/model/feeEntryServer.php";

if (isset($_GET["student_id"])) {

    $id = $_GET["student_id"];

    // student sql
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);

    // fee sql
    $sqlFee = "SELECT * FROM fee WHERE student_id = ?";
    $stmtFee = mysqli_prepare($conn, $sqlFee);
    mysqli_stmt_bind_param($stmtFee, "i", $id);
    mysqli_stmt_execute($stmtFee);
    $resultFee = mysqli_stmt_get_result($stmtFee);
    $studentFee = mysqli_fetch_assoc($resultFee);

    // fee payment
    $sqlFeePay = "SELECT * FROM fee_payments 
                  WHERE student_id = ? 
                  ORDER BY fee_month ASC 
                  LIMIT 1";
    $stmtFeePay = mysqli_prepare($conn, $sqlFeePay);
    mysqli_stmt_bind_param($stmtFeePay, "i", $id);
    mysqli_stmt_execute($stmtFeePay);
    $resultFeePay = mysqli_stmt_get_result($stmtFeePay);
    $studentFeePay = mysqli_fetch_assoc($resultFeePay);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Entry</title>
</head>

<body>

    <h1>Fee Entry</h1>

    <?php if (!empty($_SESSION["err"])) {

        foreach ($_SESSION["err"] as $err) {
            echo $err;
        }

        unset($_SESSION["err"]);
    }

    if (!empty($_SESSION['success'])) {

        foreach ($_SESSION['success'] as $success) {
            echo $success;
        }

        unset($_SESSION["success"]);

    }
    ?>

    <form action="/feeManager/server/model/feeEntryServer.php" method="post">
        <input type="text" name="name" value="<?php echo $student['first_name'] . " " . $student["last_name"]; ?>"
            readonly>
        <input type="number" style="display:none;" name="id" value="<?php echo $student["id"]; ?>">
        <div>
            <?php
            if (!empty($studentFeePay)) {
                echo "Last Payment: " . $studentFeePay["fee_month"] . ", " . $studentFeePay["fee_year"];
            } else {
                echo "No Fee Entry Before, Set a Month";
            }
            ?>
        </div>
        <label>Select Month: </label>
        <select name="month">
            <option value="JAN">JAN</option>
            <option value="FEB">FEB</option>
            <option value="MAR">MAR</option>
            <option value="APR">APR</option>
            <option value="MAY">MAY</option>
            <option value="JUN">JUN</option>
            <option value="JUl">JUl</option>
            <option value="AUG">AUG</option>
            <option value="SEP">SEP</option>
            <option value="OCT">OCT</option>
            <option value="NOV">NOV</option>
            <option value="DEC">DEC</option>
        </select>

        <label>Select Year: </label>
        <select name="year">
            <?php for ($y = 2026; $y <= 2050; $y++) { ?>
                <option value="<?php echo $y; ?>"><?php echo $y; ?></option>
            <?php } ?>
        </select>
        <input type="text" name="fee_amount" value="<?php
        if (!empty($studentFee)) {
            echo $studentFee["fee_amount"];
        } else {
            echo "Fee Not Set";
        }
        ?>" readonly>
        <button name="fee_entry">Entry Fee</button>
    </form>
</body>

</html>