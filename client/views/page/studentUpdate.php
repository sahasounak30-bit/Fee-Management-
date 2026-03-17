<?php
include_once __DIR__ . "/../../../server/model/studentUpdateServer.php";

if (empty($_SESSION["student"])) {
    header("Location: /feeManager/client/views/page/studentFetch.php");
    exit;
}

$s = $_SESSION["student"]; // shorthand
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student — <?= htmlspecialchars($s['first_name'] . ' ' . $s['last_name']) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/feeManager/client/public/css/studentUpdate.css">
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
            <div class="logo-sub">UPDATE STUDENT</div>
        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-ghost">← Back</a>
</div>

<!-- ── MAIN ── -->
<div class="wrapper">

    <!-- Header -->
    <div class="page-header">
        <h1>Update <span>Student</span></h1>
        <p>Edit the details below and save your changes.</p>
    </div>

    <!-- Student Pill -->
    <?php
        $initials = strtoupper(substr($s['first_name'], 0, 1) . substr($s['last_name'], 0, 1));
        $fullName = htmlspecialchars($s['first_name'] . ' ' . $s['last_name']);
    ?>
    <div class="student-pill">
        <div class="pill-avatar"><?= $initials ?></div>
        <div>
            <div class="pill-name"><?= $fullName ?></div>
            <div class="pill-id">ID · <?= str_pad($s['id'], 4, "0", STR_PAD_LEFT) ?></div>
        </div>
    </div>

    <!-- Errors -->
    <?php if (!empty($_SESSION["err"])): ?>
    <div class="alerts">
        <?php foreach ($_SESSION["err"] as $e): ?>
            <div class="alert alert-err">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <?= htmlspecialchars($e) ?>
            </div>
        <?php endforeach; unset($_SESSION["err"]); ?>
    </div>
    <?php endif; ?>

    <!-- Form -->
    <div class="form-card">
        <div class="form-card-bar"></div>

        <form action="/feeManager/server/model/studentUpdateServer.php" method="post" id="updateForm">

            <input type="hidden" name="id" value="<?= htmlspecialchars($s['id']) ?>">

            <!-- ── PERSONAL INFO ── -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--warn)" stroke-width="2.5" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    Personal Info
                </div>

                <div class="field-grid">

                    <div class="field">
                        <label>First Name <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                            <input type="text" name="first_name" required
                                   value="<?= htmlspecialchars($s['first_name']) ?>"
                                   data-original="<?= htmlspecialchars($s['first_name']) ?>">
                        </div>
                    </div>

                    <div class="field">
                        <label>Last Name <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                            <input type="text" name="last_name" required
                                   value="<?= htmlspecialchars($s['last_name']) ?>"
                                   data-original="<?= htmlspecialchars($s['last_name']) ?>">
                        </div>
                    </div>

                    <div class="field">
                        <label>Phone <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.39 19a19.45 19.45 0 0 1-6-6A19.79 19.79 0 0 1 3.12 4.18 2 2 0 0 1 5.09 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L9.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                            <input type="tel" name="phone" required
                                   value="<?= htmlspecialchars($s['phone']) ?>"
                                   data-original="<?= htmlspecialchars($s['phone']) ?>">
                        </div>
                    </div>

                    <div class="field">
                        <label>Date of Birth <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                            <input type="date" name="dob" required
                                   value="<?= htmlspecialchars($s['dob']) ?>"
                                   data-original="<?= htmlspecialchars($s['dob']) ?>">
                        </div>
                    </div>

                    <div class="field">
                        <label>Gender <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg></span>
                            <select name="gender" required data-original="<?= htmlspecialchars($s['gender']) ?>">
                                <option value="">Select gender</option>
                                <option value="male"   <?= $s['gender'] === 'male'   ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?= $s['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                                <option value="other"  <?= $s['gender'] === 'other'  ? 'selected' : '' ?>>Other</option>
                            </select>
                            <span class="select-arrow"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg></span>
                        </div>
                    </div>

                    <div class="field full">
                        <label>Address <span class="req">*</span></label>
                        <div class="input-wrap" style="align-items:flex-start;">
                            <span class="input-icon" style="top:12px;position:absolute;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <textarea name="address" required
                                      data-original="<?= htmlspecialchars($s['address']) ?>"><?= htmlspecialchars($s['address']) ?></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ── ACADEMIC INFO ── -->
            <div class="form-section">
                <div class="section-title">
                    <div class="section-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--warn)" stroke-width="2.5" stroke-linecap="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    </div>
                    Academic Info
                </div>

                <div class="field-grid">

                    <div class="field full">
                        <label>Education Qualification <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg></span>
                            <select name="edu_qualification" required data-original="<?= htmlspecialchars($s['edu_qualification']) ?>">
                                <option value="">Select qualification</option>
                                <?php
                                $quals = [
                                    'School' => ['Primary (1st-5th)' => 'Primary (Class 1–5)', 'Middle (6th-8th)' => 'Middle (Class 6–8)', '9th Pass' => '9th Pass', '10th Pass' => '10th Pass (Secondary)', '12th Pass' => '12th Pass (Higher Secondary)'],
                                    'Diploma / Vocational' => ['ITI' => 'ITI', 'Polytechnic Diploma' => 'Polytechnic Diploma'],
                                    'Undergraduate' => ['BA' => 'BA', 'BSc' => 'BSc', 'BCom' => 'BCom', 'BCA' => 'BCA', 'BBA' => 'BBA', 'BTech' => 'BTech', 'BE' => 'BE', 'MBBS' => 'MBBS'],
                                    'Postgraduate' => ['MA' => 'MA', 'MSc' => 'MSc', 'MCom' => 'MCom', 'MCA' => 'MCA', 'MBA' => 'MBA', 'MTech' => 'MTech', 'PhD' => 'PhD'],
                                    'Other' => ['Other' => 'Other'],
                                ];
                                foreach ($quals as $group => $options): ?>
                                    <optgroup label="<?= $group ?>">
                                        <?php foreach ($options as $val => $label): ?>
                                            <option value="<?= $val ?>" <?= $s['edu_qualification'] === $val ? 'selected' : '' ?>><?= $label ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                            <span class="select-arrow"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg></span>
                        </div>
                    </div>

                    <div class="field full">
                        <label>Admission Date <span class="req">*</span></label>
                        <div class="input-wrap">
                            <span class="input-icon"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                            <input type="date" name="admition_date" required
                                   value="<?= htmlspecialchars($s['admition_date']) ?>"
                                   data-original="<?= htmlspecialchars($s['admition_date']) ?>">
                        </div>
                    </div>

                </div>
            </div>

            <!-- ── FOOTER ── -->
            <div class="form-footer">
                <div class="footer-note">Fields marked <span>*</span> are required</div>
                <button type="submit" name="update_student" class="submit-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Changes
                </button>
            </div>

        </form>
    </div>

</div>

<script src="/feeManager/client/public/js/shortcut.js"></script>
<script src="/feeManager/client/public/js/studentUpdate.js"></script>

</body>
</html>