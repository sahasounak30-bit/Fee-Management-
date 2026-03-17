<?php
// session verification
include_once __DIR__ . "/../../../auth/session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Manager — Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/feeManager/client/public/css/home.css">
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<!-- ── TOPBAR ── -->
<div class="topbar">
    <div class="logo">
        <div class="logo-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="5" width="20" height="14" rx="2"/>
                <path d="M2 10h20"/>
            </svg>
        </div>
        <div>
            <div class="logo-name">FEE MANAGER</div>
            <div class="logo-tag">ADMIN PANEL</div>
        </div>
    </div>
    <div class="topbar-right">
        <div class="topbar-date">
            <div id="clock"></div>
            <div id="date-display"></div>
        </div>
        <a href="/feeManager/server/controller/signOutServer.php" class="signout-btn">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
            Sign Out
        </a>
    </div>
</div>

<!-- ── MAIN ── -->
<div class="main">

    <!-- Hero -->
    <div class="hero">
        <div class="hero-eyebrow">Dashboard</div>
        <h1>Manage your<br><span class="hl">student fees</span></h1>
        <p>Track admissions, collect fees, and monitor payment status — all from one place.</p>
    </div>

    <!-- Nav Grid -->
    <div class="nav-grid">

        <!-- All Students -->
        <a href="/feeManager/client/views/page/studentFetch.php" class="nav-card green">
            <div class="shortcut">S</div>
            <div class="card-icon green">👥</div>
            <div class="card-body">
                <div class="card-label">Records</div>
                <div class="card-title">All Students</div>
                <div class="card-desc">View, search and manage the complete list of enrolled students.</div>
            </div>
            <div class="card-arrow">↗</div>
        </a>

        <!-- Fee Page -->
        <a href="/feeManager/client/views/page/feePage.php" class="nav-card blue">
            <div class="shortcut">F</div>
            <div class="card-icon blue">💰</div>
            <div class="card-body">
                <div class="card-label">Finance</div>
                <div class="card-title">Fee Page</div>
                <div class="card-desc">Review due dates, payment status and filter fee reports by month.</div>
            </div>
            <div class="card-arrow">↗</div>
        </a>

        <!-- Create Student — wide -->
        <a href="/feeManager/client/views/page/studentCreate.php" class="nav-card yellow wide">
            <div class="shortcut">C</div>
            <div class="card-icon yellow">➕</div>
            <div class="card-body">
                <div class="card-label">Enroll</div>
                <div class="card-title">Create New Student</div>
                <div class="card-desc">Add a new student record with personal details, qualification, and fee assignment.</div>
            </div>
            <div class="card-arrow">↗</div>
        </a>

    </div>
</div>

<!-- ── FOOTER ── -->
<div class="footer">
    FEE MANAGER &nbsp;·&nbsp; <?= date('Y') ?> &nbsp;·&nbsp; ADMIN PANEL
</div>

<script src="/feeManager/client/public/js/home.js"></script>

</body>
</html>