<?php
include_once __DIR__ . "/../server/controller/signInServer.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Fee Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/feeManager/client/public/css/singIn.css">
</head>

<body>

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="card">

        <!-- Header -->
        <div class="card-header">
            <div class="logo-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="2" y="5" width="20" height="14" rx="2" />
                    <path d="M2 10h20" />
                </svg>
            </div>
            <h1>Welcome back</h1>
            <p>SIGN IN TO FEE MANAGER</p>
        </div>

        <!-- Errors -->
        <?php if (!empty($_SESSION["err"])): ?>
            <div class="error-box">
                <span class="err-icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                </span>
                <ul>
                    <?php foreach ($_SESSION["err"] as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach;
                    unset($_SESSION["err"]); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form action="/feeManager/server/controller/signInServer.php" method="post" class="form">

            <div class="field">
                <label>Admin Name</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </span>
                    <input type="text" name="username" placeholder="Enter admin name" autocomplete="username">
                </div>
            </div>

            <div class="field">
                <label>Email</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round">
                            <rect x="2" y="4" width="20" height="16" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                    </span>
                    <input type="email" name="email" placeholder="admin@example.com" autocomplete="email">
                </div>
            </div>

            <div class="field">
                <label>Password</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                    </span>
                    <input type="password" name="pass" id="passInput" placeholder="••••••••"
                        autocomplete="current-password">
                    <button type="button" class="toggle-pass" onclick="togglePass()" title="Show/hide password">
                        <svg id="eyeIcon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-text">SECURITY</div>
                <div class="divider-line"></div>
            </div>

            <div class="field">
                <label>Security Q&A</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                    </span>
                    <input type="text" name="qna" placeholder="Your security answer">
                </div>
            </div>

            <button type="submit" name="signIn" class="submit-btn">Sign In →</button>
        </form>

        <div class="card-footer">Fee Manager &nbsp;·&nbsp; Admin Access Only</div>
    </div>


</body>
<script src="/feeManager/client/public/js/signIn.js"></script>

</html>