<?php
include_once __DIR__ . "/../../../server/model/studentFetchServer.php";
include_once __DIR__ . "/../../../server/model/feeCreateServer.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Entry — Fee Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/feeManager/client/public/css/feePage.css">
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
                <div class="logo-sub">FEE ENTRY</div>
            </div>
        </div>
        <div class="topbar-right">
            <a href="/feeManager/client/views/page/index.php" class="btn btn-ghost">← Home</a>

            <!-- Filter button -->
            <form action="/feeManager/server/model/feeFilterServer.php" method="post" style="margin:0;">
                <button type="submit" name="filter" class="btn btn-accent">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg>
                    Filter Report
                </button>
            </form>
        </div>
    </div>

    <!-- ── MAIN ── -->
    <div class="wrapper">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Fee <span>Entry</span></h1>
                <p>Manage fee creation and payment entries for each student.</p>
            </div>
        </div>

        <!-- Alerts -->
        <?php
        $has_err = !empty($_SESSION["err"]);
        $has_success = !empty($_SESSION["success"]);
        ?>
        <?php if ($has_err || $has_success): ?>
            <div class="alerts">
                <?php if ($has_err):
                    foreach ($_SESSION["err"] as $err): ?>
                        <div class="alert alert-err">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" style="flex-shrink:0;margin-top:1px">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            <?= htmlspecialchars($err) ?>
                        </div>
                    <?php endforeach;
                    unset($_SESSION["err"]);
                endif; ?>

                <?php if ($has_success):
                    foreach ($_SESSION["success"] as $success): ?>
                        <div class="alert alert-success">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" style="flex-shrink:0;margin-top:1px">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="9 12 11 14 15 10" />
                            </svg>
                            <?= htmlspecialchars($success) ?>
                        </div>
                    <?php endforeach;
                    unset($_SESSION["success"]);
                endif; ?>
            </div>
        <?php endif; ?>

        <!-- Search -->
        <?php if (!empty($row)): ?>
            <div class="search-bar">
                <span class="search-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </span>
                <input type="text" class="search-input" id="searchInput" placeholder="Search student by name..."
                    oninput="searchCards()">
                <span class="search-count" id="countBadge"><?= count($row) ?> students</span>
            </div>
        <?php endif; ?>

        <!-- Students Grid -->
        <div class="students-grid" id="studentGrid">

            <?php if (!empty($row)): ?>
                <?php foreach ($row as $r):
                    $initials = strtoupper(substr($r["first_name"], 0, 1) . substr($r["last_name"], 0, 1));
                    ?>
                    <div class="std-card"
                        data-name="<?= strtolower(htmlspecialchars($r["first_name"] . ' ' . $r["last_name"])) ?>">
                        <div class="card-top">
                            <div class="avatar"><?= $initials ?></div>
                            <div class="card-info">
                                <div class="card-name"><?= htmlspecialchars($r["first_name"] . " " . $r["last_name"]) ?></div>
                                <span class="card-id">ID · <?= str_pad($r["id"], 4, "0", STR_PAD_LEFT) ?></span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <a href="/feeManager/client/views/page/feeCreate.php?student_id=<?= $r['id'] ?>"
                                class="action-btn action-create">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Create Fee
                            </a>
                            <a href="/feeManager/client/views/page/feeEntry.php?student_id=<?= $r['id'] ?>"
                                class="action-btn action-entry">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                                Fee Entry
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <h3>No Students Found</h3>
                    <p>No student records are available yet.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script src="/feeManager/client/public/js/shortcut.js"></script>
    <script src="/feeManager/client/public/js/feePage.js"></script>

</body>

</html>