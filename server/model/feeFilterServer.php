<?php
// sesstion start
session_start();

// db link fire
include_once __DIR__ . "/../../server/config/db.php";

if (isset($_POST["filter"])) {

    $sql = "
            SELECT
    s.id,

    CONCAT(s.first_name, ' ', s.last_name) AS student_name,

    s.phone,
    s.admition_date,

    -- 📅 Current month due date (based on today)
    DATE_ADD(
        s.admition_date,
        INTERVAL TIMESTAMPDIFF(
            MONTH,
            s.admition_date,
            CURDATE()
        ) MONTH
    ) AS current_due_date,

    -- 📅 Next month due date
    DATE_ADD(
        s.admition_date,
        INTERVAL TIMESTAMPDIFF(
            MONTH,
            s.admition_date,
            CURDATE()
        ) + 1 MONTH
    ) AS next_due_date,

    -- 💰 Fee details
    f.fee_amount AS total_fee,

    COALESCE(fp.amount_paid, 0.00) AS amount_paid,
    COALESCE(fp.status, 'pending') AS payment_status,

    -- ⏱️ Overdue days (0 if already paid)
    CASE
        WHEN COALESCE(fp.status, 'pending') = 'paid' THEN 0
        ELSE GREATEST(
            0,
            DATEDIFF(
                CURDATE(),
                DATE_ADD(
                    s.admition_date,
                    INTERVAL TIMESTAMPDIFF(
                        MONTH,
                        s.admition_date,
                        CURDATE()
                    ) MONTH
                )
            )
        )
    END AS days_overdue

FROM students s

INNER JOIN fee f
    ON s.id = f.student_id

LEFT JOIN fee_payments fp
    ON s.id = fp.student_id

ORDER BY
    s.admition_date;
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $rows = [];

    while ($student_fee = mysqli_fetch_assoc($result)) {
        $rows[] = $student_fee; // ✅ store all rows
    }

    if (empty($rows)) {
        $_SESSION["err"][] = "No student found";
    } else {
        $_SESSION["data"] = $rows; // ✅ store in session
    }

    header("Location: /feeManager/client/views/page/feeFilter.php");
    exit;
}