<?php
// session verification
include_once __DIR__ . "/../../../auth/session.php";

include_once __DIR__ . "/../../../server/config/db.php";
include_once __DIR__ . "/../../../server/model/feeEntryServer.php";

if (isset($_GET["student_id"])) {
    $id = $_GET["student_id"];

    $sql  = "SELECT * FROM students WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $student = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    $sqlFee  = "SELECT * FROM fee WHERE student_id = ?";
    $stmtFee = mysqli_prepare($conn, $sqlFee);
    mysqli_stmt_bind_param($stmtFee, "i", $id);
    mysqli_stmt_execute($stmtFee);
    $studentFee = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtFee));

    $sqlFeePay  = "SELECT * FROM fee_payments WHERE student_id = ? ORDER BY payment_date ASC LIMIT 1";
    $stmtFeePay = mysqli_prepare($conn, $sqlFeePay);
    mysqli_stmt_bind_param($stmtFeePay, "i", $id);
    mysqli_stmt_execute($stmtFeePay);
    $studentFeePay = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtFeePay));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Entry — <?= htmlspecialchars(($student['first_name'] ?? '') . ' ' . ($student['last_name'] ?? '')) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/feeManager/client/public/css/feeEntry.css">
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<!-- ── TOPBAR ── -->
<div class="topbar">
    <div class="topbar-left">
        <div class="logo-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>
            </svg>
        </div>
        <div>
            <div class="logo-text">FEE MANAGER</div>
            <div class="logo-sub">FEE ENTRY</div>
        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-ghost">← Back</a>
</div>

<!-- ── MAIN ── -->
<div class="main">
<div class="card">

    <div class="card-accent-bar"></div>

    <!-- Student Banner -->
    <?php if (!empty($student)):
        $initials = strtoupper(substr($student['first_name'], 0, 1) . substr($student['last_name'], 0, 1));
        $fullName = htmlspecialchars($student['first_name'] . ' ' . $student['last_name']);
    ?>
    <div class="student-banner">
        <div class="avatar"><?= $initials ?></div>
        <div>
            <div class="student-label">Recording payment for</div>
            <div class="student-name"><?= $fullName ?></div>
            <span class="student-id">ID · <?= str_pad($student['id'], 4, "0", STR_PAD_LEFT) ?></span>
        </div>
    </div>

    <!-- Fee Summary Strip -->
    <div class="fee-strip">
        <div class="fee-strip-item">
            <div class="fee-strip-label">Monthly Fee</div>
            <?php if (!empty($studentFee)): ?>
                <div class="fee-strip-value">₹<?= number_format($studentFee['fee_amount'], 2) ?></div>
            <?php else: ?>
                <div class="fee-strip-value muted">Not set</div>
            <?php endif; ?>
        </div>
        <div class="fee-strip-item">
            <div class="fee-strip-label">Admission Date</div>
            <div class="fee-strip-value muted"><?= date('d M Y', strtotime($student['admition_date'])) ?></div>
        </div>
    </div>

    <!-- Last Payment Banner -->
    <?php if (!empty($studentFeePay)): ?>
        <div class="last-pay-banner has-pay">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
            Last payment recorded on <strong>&nbsp;<?= htmlspecialchars($studentFeePay['payment_date']) ?></strong>
        </div>
    <?php else: ?>
        <div class="last-pay-banner no-pay">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            No previous payment — this will be the first entry
        </div>
    <?php endif; ?>

    <?php endif; ?>

    <!-- Form -->
    <div class="form-body">
        <div class="form-title">Record <span>Payment</span></div>

        <!-- Alerts -->
        <?php
            $has_err     = !empty($_SESSION["err"]);
            $has_success = !empty($_SESSION["success"]);
        ?>
        <?php if ($has_err || $has_success): ?>
        <div class="alerts">
            <?php if ($has_err): foreach ($_SESSION["err"] as $e): ?>
                <div class="alert alert-err">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <?= htmlspecialchars($e) ?>
                </div>
            <?php endforeach; unset($_SESSION["err"]); endif; ?>
            <?php if ($has_success): foreach ($_SESSION["success"] as $s): ?>
                <div class="alert alert-success">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                    <?= htmlspecialchars($s) ?>
                </div>
            <?php endforeach; unset($_SESSION["success"]); endif; ?>
        </div>
        <?php endif; ?>

        <form action="/feeManager/server/model/feeEntryServer.php" method="post">

            <input type="hidden" name="id" value="<?= htmlspecialchars($student['id'] ?? '') ?>">

            <!-- Student name readonly -->
            <div class="field">
                <label>Student Name</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
                    <input type="text" name="name"
                           value="<?= htmlspecialchars(($student['first_name'] ?? '') . ' ' . ($student['last_name'] ?? '')) ?>"
                           readonly>
                </div>
            </div>

            <!-- Receipt date -->
            <div class="field">
                <label>Receipt Date</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </span>
                    <input type="date" name="fee_date" required
                           value="<?= date('Y-m-d') ?>">
                </div>
            </div>

            <!-- Fee amount readonly -->
            <div class="field">
                <label>Fee Amount</label>
                <div class="input-wrap">
                    <span class="input-icon" style="font-size:0.78rem;font-family:'Syne',sans-serif;font-weight:700;">₹</span>
                    <input type="text" name="fee_amount"
                           value="<?= !empty($studentFee) ? htmlspecialchars($studentFee['fee_amount']) : 'Fee not set' ?>"
                           readonly>
                </div>
            </div>

            <button type="submit" name="fee_entry" class="submit-btn">Record Entry →</button>
        </form>
    </div>

</div>
</div>

<script src="/feeManager/client/public/js/shortcut.js"></script>
</body>
</html>