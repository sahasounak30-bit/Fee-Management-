<?php
include_once __DIR__ . "/../../../server/config/db.php";
include_once __DIR__ . "/../../../server/model/feeCreateServer.php";

if (isset($_GET["student_id"])) {
    $id = $_GET["student_id"];
    $sql = "SELECT * FROM students WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Fee — <?= htmlspecialchars($student['first_name'] ?? 'Student') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/feeManager/client/public/css/feeCreate.css">
</head>

<body>

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- ── TOPBAR ── -->
    <div class="topbar">
        <div class="topbar-left">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="2" y="5" width="20" height="14" rx="2" />
                    <path d="M2 10h20" />
                </svg>
            </div>
            <div>
                <div class="logo-text">FEE MANAGER</div>
                <div class="logo-sub">CREATE FEE</div>
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
                ?>
                <div class="student-banner">
                    <div class="avatar"><?= $initials ?></div>
                    <div class="student-info">
                        <div class="student-label">Setting fee for</div>
                        <div class="student-name">
                            <?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></div>
                        <span class="student-id">ID · <?= str_pad($student['id'], 4, "0", STR_PAD_LEFT) ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Form Body -->
            <div class="form-body">
                <div class="form-title">Set <span>Fee Amount</span></div>

                <!-- Alerts -->
                <?php
                $has_err = !empty($_SESSION["err"]);
                $has_success = !empty($_SESSION["success"]);
                ?>
                <?php if ($has_err || $has_success): ?>
                    <div class="alerts">
                        <?php if ($has_err):
                            foreach ($_SESSION["err"] as $e): ?>
                                <div class="alert alert-err">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;margin-top:1px">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" y1="8" x2="12" y2="12" />
                                        <line x1="12" y1="16" x2="12.01" y2="16" />
                                    </svg>
                                    <?= htmlspecialchars($e) ?>
                                </div>
                            <?php endforeach;
                            unset($_SESSION["err"]); endif; ?>
                        <?php if ($has_success):
                            foreach ($_SESSION["success"] as $s): ?>
                                <div class="alert alert-success">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" style="flex-shrink:0;margin-top:1px">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="9 12 11 14 15 10" />
                                    </svg>
                                    <?= htmlspecialchars($s) ?>
                                </div>
                            <?php endforeach;
                            unset($_SESSION["success"]); endif; ?>
                    </div>
                <?php endif; ?>

                <form action="/feeManager/server/model/feeCreateServer.php" method="post">

                    <!-- Hidden student id -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($student['id'] ?? '') ?>">

                    <!-- Name (readonly) -->
                    <div class="field">
                        <label>Student Name</label>
                        <div class="input-wrap">
                            <span class="input-icon">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </span>
                            <input type="text" name="name" value="<?= htmlspecialchars($student['first_name'] ?? '') ?>"
                                readonly>
                        </div>
                    </div>

                    <!-- Fee amount -->
                    <div class="field">
                        <label>Fee Amount</label>
                        <div class="input-wrap">
                            <span class="currency-prefix">₹</span>
                            <input type="number" name="fee_amount" id="feeInput" class="fee-input" placeholder="0.00"
                                min="0" step="0.01" required>
                        </div>
                    </div>

                    <!-- Quick amounts -->
                    <div class="quick-label">Quick Select</div>
                    <div class="quick-amounts">
                        <button type="button" class="quick-btn" onclick="setFee(500)">₹500</button>
                        <button type="button" class="quick-btn" onclick="setFee(1000)">₹1,000</button>
                        <button type="button" class="quick-btn" onclick="setFee(2000)">₹2,000</button>
                        <button type="button" class="quick-btn" onclick="setFee(5000)">₹5,000</button>
                        <button type="button" class="quick-btn" onclick="setFee(10000)">₹10,000</button>
                    </div>

                    <button type="submit" name="set_fee" class="submit-btn">Set Fee →</button>
                </form>
            </div>

        </div>
    </div>

    <script src="/feeManager/client/public/js/shortcut.js"></script>
    <script src="/feeManager/client/public/js/feeCreate.js"></script>

</body>

</html>