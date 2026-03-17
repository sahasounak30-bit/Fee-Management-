<?php
session_start();
include_once __DIR__ . "/../../../server/model/studentFetchServer.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students — Fee Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/feeManager/client/public/css/studentFetch.css">
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
            <div class="logo-sub">ALL STUDENTS</div>
        </div>
    </div>
    <div class="topbar-right">
        <a href="/feeManager/client/views/page/home.php" class="btn btn-ghost">← Home</a>
        <a href="/feeManager/client/views/page/studentCreate.php" class="btn btn-accent">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Student
        </a>
    </div>
</div>

<!-- ── MAIN ── -->
<div class="wrapper">

    <!-- Header -->
    <div class="page-header">
        <div>
            <h1>All <span>Students</span></h1>
            <p>View, manage and track all enrolled students.</p>
        </div>
    </div>

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
        <?php if ($has_success): ?>
            <div class="alert alert-success">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                <?= htmlspecialchars($_SESSION["success"]) ?>
            </div>
        <?php unset($_SESSION["success"]); endif; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($row)): ?>

    <!-- Search -->
    <div class="search-bar">
        <span class="search-icon">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </span>
        <input type="text" class="search-input" id="searchInput"
               placeholder="Search by name or phone..."
               oninput="searchRows()">
        <span class="search-count" id="countBadge"><?= count($row) ?> students</span>
    </div>

    <!-- Table -->
    <div class="table-wrap">
        <div class="table-scroll">
        <table class="std-table" id="stdTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Admission</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($row as $r):
                $initials = strtoupper(substr($r['first_name'], 0, 1) . substr($r['last_name'], 0, 1));
                $fullName = htmlspecialchars($r['first_name'] . ' ' . $r['last_name']);
                $gender   = strtolower($r['gender']);
            ?>
            <tr data-name="<?= strtolower($fullName) ?>" data-phone="<?= htmlspecialchars($r['phone']) ?>">

                <td><span class="id-badge"><?= str_pad($r['id'], 4, "0", STR_PAD_LEFT) ?></span></td>

                <td>
                    <div class="name-cell">
                        <div class="avatar"><?= $initials ?></div>
                        <span class="name-text"><?= $fullName ?></span>
                    </div>
                </td>

                <td><?= htmlspecialchars($r['phone']) ?></td>

                <td><?= date('d M Y', strtotime($r['dob'])) ?></td>

                <td>
                    <span class="gender-badge gender-<?= $gender ?>">
                        <?= ucfirst($gender) ?>
                    </span>
                </td>

                <td><?= date('d M Y', strtotime($r['admition_date'])) ?></td>

                <td>
                    <div class="actions">
                        <!-- View -->
                        <button class="action-btn action-view" onclick="openModal(<?= htmlspecialchars(json_encode($r)) ?>)">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            View
                        </button>

                        <!-- Update -->
                        <form action="/feeManager/server/model/studentUpdateServer.php" method="post" style="margin:0;">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <button type="submit" name="updateBtn" class="action-btn action-update">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4z"/></svg>
                                Edit
                            </button>
                        </form>

                        <!-- Delete -->
                        <button class="action-btn action-delete"
                                onclick="openConfirm(<?= $r['id'] ?>, '<?= addslashes($fullName) ?>')">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>

    <?php else: ?>
    <div class="empty-state">
        <div class="empty-icon">👤</div>
        <h3>No Students Yet</h3>
        <p>Create your first student to get started.</p>
    </div>
    <?php endif; ?>

</div>

<!-- ── VIEW MODAL ── -->
<div class="modal-overlay" id="viewModal">
    <div class="modal">
        <div class="modal-bar"></div>
        <div class="modal-body">
            <div class="modal-title">Student <span>Details</span></div>
            <div class="modal-row"><div class="modal-label">Full Name</div>   <div class="modal-value" id="m-name"></div></div>
            <div class="modal-row"><div class="modal-label">Phone</div>       <div class="modal-value" id="m-phone"></div></div>
            <div class="modal-row"><div class="modal-label">Date of Birth</div><div class="modal-value" id="m-dob"></div></div>
            <div class="modal-row"><div class="modal-label">Gender</div>      <div class="modal-value" id="m-gender"></div></div>
            <div class="modal-row"><div class="modal-label">Education</div>   <div class="modal-value" id="m-edu"></div></div>
            <div class="modal-row"><div class="modal-label">Address</div>     <div class="modal-value" id="m-address" style="white-space:pre-wrap;"></div></div>
            <div class="modal-row"><div class="modal-label">Admission</div>   <div class="modal-value" id="m-admission"></div></div>
        </div>
        <div class="modal-footer">
            <button class="modal-close" onclick="closeModal()">Close</button>
        </div>
    </div>
</div>

<!-- ── CONFIRM DELETE ── -->
<div class="confirm-overlay" id="confirmOverlay">
    <div class="confirm-box">
        <div class="confirm-icon">🗑️</div>
        <h3>Delete Student?</h3>
        <p id="confirmText">This will permanently remove the student and all their fee records.</p>
        <div class="confirm-actions">
            <button class="confirm-cancel" onclick="closeConfirm()">Cancel</button>
            <form id="deleteForm" action="/feeManager/server/model/studentDeleteServer.php" method="post" style="flex:1;display:contents;">
                <input type="hidden" name="id" id="deleteId">
                <button type="submit" name="deleteBtn" class="confirm-delete-btn">Yes, Delete</button>
            </form>
        </div>
    </div>
</div>

<script src="/feeManager/client/public/js/shortcut.js"></script>
<script src="/feeManager/client/public/js/studentFetch.js"></script>

</body>
</html>