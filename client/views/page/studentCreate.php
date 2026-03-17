<?php
include_once __DIR__ . "/../../../server/model/studentCreateServer.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student — Fee Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/feeManager/client/public/css/studentCreate.css">
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
                <div class="logo-sub">ENROLL STUDENT</div>
            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-ghost">← Back</a>
    </div>

    <!-- ── MAIN ── -->
    <div class="wrapper">

        <!-- Header -->
        <div class="page-header">
            <h1>Create <span>Student</span></h1>
            <p>Fill in the details below to enroll a new student.</p>
        </div>

        <!-- Errors -->
        <?php if (!empty($_SESSION["err"])): ?>
            <div class="alerts">
                <?php foreach ($_SESSION["err"] as $err): ?>
                    <div class="alert alert-err">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        <?= htmlspecialchars($err) ?>
                    </div>
                <?php endforeach;
                unset($_SESSION["err"]); ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <div class="form-card">
            <div class="form-card-bar"></div>

            <form action="/feeManager/server/model/studentCreateServer.php" method="post">

                <!-- ── PERSONAL INFO ── -->
                <div class="form-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--accent)"
                                stroke-width="2.5" stroke-linecap="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        Personal Info
                    </div>
                    <div class="field-grid">

                        <div class="field">
                            <label>First Name <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </span>
                                <input type="text" name="first_name" placeholder="First name" required>
                            </div>
                        </div>

                        <div class="field">
                            <label>Last Name <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                </span>
                                <input type="text" name="last_name" placeholder="Last name" required>
                            </div>
                        </div>

                        <div class="field">
                            <label>Phone <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.39 19a19.45 19.45 0 0 1-6-6A19.79 19.79 0 0 1 3.12 4.18 2 2 0 0 1 5.09 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L9.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                                    </svg>
                                </span>
                                <input type="tel" name="phone" placeholder="Phone number" required>
                            </div>
                        </div>

                        <div class="field">
                            <label>Date of Birth <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                </span>
                                <input type="date" name="dob" required>
                            </div>
                        </div>

                        <div class="field">
                            <label>Gender <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <circle cx="12" cy="12" r="4" />
                                        <path
                                            d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                                    </svg>
                                </span>
                                <select name="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <span class="select-arrow"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                        <polyline points="6 9 12 15 18 9" />
                                    </svg></span>
                            </div>
                        </div>

                        <div class="field full">
                            <label>Address <span class="req">*</span></label>
                            <div class="input-wrap" style="align-items:flex-start;">
                                <span class="input-icon" style="top:12px;position:absolute;">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                </span>
                                <textarea name="address" placeholder="Full address" required></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ── ACADEMIC INFO ── -->
                <div class="form-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--accent)"
                                stroke-width="2.5" stroke-linecap="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                <path d="M6 12v5c3 3 9 3 12 0v-5" />
                            </svg>
                        </div>
                        Academic Info
                    </div>
                    <div class="field-grid">

                        <div class="field full">
                            <label>Education Qualification <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                        <path d="M6 12v5c3 3 9 3 12 0v-5" />
                                    </svg>
                                </span>
                                <select name="edu_qualification" required>
                                    <option value="">Select qualification</option>
                                    <optgroup label="School">
                                        <option value="Primary (1st-5th)">Primary (Class 1–5)</option>
                                        <option value="Middle (6th-8th)">Middle (Class 6–8)</option>
                                        <option value="9th Pass">9th Pass</option>
                                        <option value="10th Pass">10th Pass (Secondary)</option>
                                        <option value="12th Pass">12th Pass (Higher Secondary)</option>
                                    </optgroup>
                                    <optgroup label="Diploma / Vocational">
                                        <option value="ITI">ITI</option>
                                        <option value="Polytechnic Diploma">Polytechnic Diploma</option>
                                    </optgroup>
                                    <optgroup label="Undergraduate">
                                        <option value="BA">BA</option>
                                        <option value="BSc">BSc</option>
                                        <option value="BCom">BCom</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BBA">BBA</option>
                                        <option value="BTech">BTech</option>
                                        <option value="BE">BE</option>
                                        <option value="MBBS">MBBS</option>
                                    </optgroup>
                                    <optgroup label="Postgraduate">
                                        <option value="MA">MA</option>
                                        <option value="MSc">MSc</option>
                                        <option value="MCom">MCom</option>
                                        <option value="MCA">MCA</option>
                                        <option value="MBA">MBA</option>
                                        <option value="MTech">MTech</option>
                                        <option value="PhD">PhD</option>
                                    </optgroup>
                                    <optgroup label="Other">
                                        <option value="Other">Other</option>
                                    </optgroup>
                                </select>
                                <span class="select-arrow"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                        <polyline points="6 9 12 15 18 9" />
                                    </svg></span>
                            </div>
                        </div>

                        <div class="field full">
                            <label>Admission Date <span class="req">*</span></label>
                            <div class="input-wrap">
                                <span class="input-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                </span>
                                <input type="date" name="admition_date" required value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ── FOOTER ── -->
                <div class="form-footer">
                    <div class="footer-note">Fields marked <span>*</span> are required</div>
                    <button type="submit" name="create_student" class="submit-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Create Student
                    </button>
                </div>

            </form>
        </div>

    </div>

    <script src="/feeManager/client/public/js/shortcut.js"></script>
</body>

</html>