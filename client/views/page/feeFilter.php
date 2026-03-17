<?php
// session verification
include_once __DIR__ . "/../../../auth/session.php";

$rows = $_SESSION["data"] ?? [];
$errors = $_SESSION["err"] ?? [];
unset($_SESSION["err"]);

// Summary calculations
$total_students  = count($rows);
$paid_count      = count(array_filter($rows, fn($r) => $r["payment_status"] === "paid"));
$pending_count   = count(array_filter($rows, fn($r) => $r["payment_status"] === "pending"));
$partial_count   = count(array_filter($rows, fn($r) => $r["payment_status"] === "partial"));
$total_collected = array_sum(array_column($rows, "amount_paid"));
$total_due       = array_sum(array_column($rows, "total_fee"));
$overdue_students = count(array_filter($rows, fn($r) => $r["days_overdue"] > 0));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Fee Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="/feeManager/client/public/css/feeFilter.css">
</head>
<body>

<!-- ── TOP BAR ── -->
<div class="topbar">
    <div class="topbar-left">
        <div class="topbar-logo">
            <svg viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round">
                <rect x="2" y="5" width="20" height="14" rx="2"/>
                <path d="M2 10h20"/>
            </svg>
        </div>
        <div>
            <h1>FEE MANAGER</h1>
            <div class="topbar-date"><?= date('l, d M Y') ?></div>
        </div>
    </div>
    <div class="topbar-actions">
        <button class="btn btn-ghost" onclick="window.print()">⎙ Print</button>
    </div>
</div>

<!-- ── MAIN ── -->
<div class="wrapper">

    <a href="javascript:history.back()" class="back-link">← Back</a>

    <!-- Page Header -->
    <div class="page-header">
        <h2>Student Fee <span>Report</span></h2>
        <p>Generated on <?= date('d M Y, h:i A') ?> &nbsp;·&nbsp; <?= $total_students ?> students found</p>
    </div>

    <!-- Errors -->
    <?php foreach ($errors as $err): ?>
        <div class="error-box">⚠ <?= htmlspecialchars($err) ?></div>
    <?php endforeach; ?>

    <!-- Stats -->
    <?php if (!empty($rows)): ?>
    <div class="stats-grid">
        <div class="stat-card green">
            <div class="stat-label">Total Students</div>
            <div class="stat-value green"><?= $total_students ?></div>
            <div class="stat-sub"><?= $overdue_students ?> overdue</div>
            <div class="stat-icon">👥</div>
        </div>
        <div class="stat-card blue">
            <div class="stat-label">Total Collected</div>
            <div class="stat-value blue">₹<?= number_format($total_collected, 0) ?></div>
            <div class="stat-sub">of ₹<?= number_format($total_due, 0) ?> total</div>
            <div class="stat-icon">💰</div>
        </div>
        <div class="stat-card yellow">
            <div class="stat-label">Pending / Partial</div>
            <div class="stat-value yellow"><?= $pending_count + $partial_count ?></div>
            <div class="stat-sub"><?= $pending_count ?> pending · <?= $partial_count ?> partial</div>
            <div class="stat-icon">⏳</div>
        </div>
        <div class="stat-card green">
            <div class="stat-label">Fully Paid</div>
            <div class="stat-value green"><?= $paid_count ?></div>
            <div class="stat-sub"><?= $total_students > 0 ? round($paid_count / $total_students * 100) : 0 ?>% completion</div>
            <div class="stat-icon">✅</div>
        </div>
    </div>

    <!-- Filter / Search Bar -->
    <div class="filter-bar">
        <label>SEARCH</label>
        <input type="text" class="filter-input" id="searchInput" placeholder="student name or phone..." oninput="filterTable()"/>
        <div class="filter-sep">|</div>
        <label>STATUS</label>
        <div class="filter-chips">
            <button class="chip active"        onclick="filterChip(this,'all')">All</button>
            <button class="chip"               onclick="filterChip(this,'paid')">Paid</button>
            <button class="chip yellow"        onclick="filterChip(this,'pending')">Pending</button>
        </div>
    </div>

    <!-- Table -->
    <div class="table-wrap">
        <div class="table-head-bar">
            <span>Fee Records</span>
            <div class="table-count" id="rowCount"><?= $total_students ?> records</div>
        </div>
        <div style="overflow-x:auto;">
        <table class="fee-table" id="feeTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Admission</th>
                    <th>Current Due</th>
                    <th>Next Due</th>
                    <th>Fee / Paid</th>
                    <th>Progress</th>
                    <th>Overdue</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $i => $r):
                $pct = $r["total_fee"] > 0 ? round(($r["amount_paid"] / $r["total_fee"]) * 100) : 0;
                $fill_class = $r["payment_status"] === 'paid' ? '' : ($r["payment_status"] === 'partial' ? 'partial' : 'pending');
            ?>
            <tr data-status="<?= htmlspecialchars($r["payment_status"]) ?>"
                data-name="<?= strtolower(htmlspecialchars($r["student_name"])) ?>"
                data-phone="<?= htmlspecialchars($r["phone"]) ?>">

                <td><span class="id-badge"><?= str_pad($r["id"], 4, "0", STR_PAD_LEFT) ?></span></td>

                <td>
                    <div class="student-name"><?= htmlspecialchars($r["student_name"]) ?></div>
                    <div class="student-phone"><?= htmlspecialchars($r["phone"]) ?></div>
                </td>

                <td><?= date('d M Y', strtotime($r["admition_date"])) ?></td>

                <td>
                    <div class="due-date">
                        <div class="date-main"><?= date('d M Y', strtotime($r["current_due_date"])) ?></div>
                    </div>
                </td>

                <td>
                    <div class="due-date">
                        <div class="date-next"><?= date('d M Y', strtotime($r["next_due_date"])) ?></div>
                    </div>
                </td>

                <td>
                    <div class="amount-paid">₹<?= number_format($r["amount_paid"], 2) ?></div>
                    <div class="amount-total">of ₹<?= number_format($r["total_fee"], 2) ?></div>
                </td>

                <td>
                    <div class="fee-progress">
                        <div class="progress-bar">
                            <div class="progress-fill <?= $fill_class ?>" style="width:<?= $pct ?>%"></div>
                        </div>
                        <div class="progress-text"><?= $pct ?>%</div>
                    </div>
                </td>

                <td>
                    <?php if ($r["days_overdue"] > 0): ?>
                        <span class="overdue-badge">⚠ <?= $r["days_overdue"] ?>d</span>
                    <?php else: ?>
                        <span class="overdue-zero">—</span>
                    <?php endif; ?>
                </td>

                <td>
                    <span class="status-badge status-<?= htmlspecialchars($r["payment_status"]) ?>">
                        <?= ucfirst($r["payment_status"]) ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>

    <?php else: ?>
    <!-- Empty State -->
    <div class="table-wrap">
        <div class="empty-state">
            <div class="empty-icon">📋</div>
            <h3>No Records Found</h3>
            <p>Apply a filter to load student fee data.</p>
        </div>
    </div>
    <?php endif; ?>

</div>

<script src="/feeManager/client/public/js/feeFilter.js"></script>

</body>
</html>