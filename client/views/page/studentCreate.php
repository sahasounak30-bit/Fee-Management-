<?php
include_once __DIR__ . "/../../../server/model/studentCreateServer.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Create</title>
</head>

<body>
    <?php
    if (!empty($_SESSION["err"])) {
        foreach ($_SESSION["err"] as $err) {
            echo $err;
        }
        unset($_SESSION["err"]);
    }
    ?>
    <h1>Student Create</h1>

    <form action="/feeManager/server/model/studentCreateServer.php" method="post">

        <!-- First Name -->
        <label for="first_name">First Name:</label><br>
        <input type="text" name="first_name" required><br><br>

        <!-- Last Name -->
        <label for="last_name">Last Name:</label><br>
        <input type="text" name="last_name" required><br><br>

        <!-- Phone -->
        <label for="phone">Phone:</label><br>
        <input type="tel" name="phone" required><br><br>

        <!-- Date of Birth -->
        <label for="dob">Date of Birth:</label><br>
        <input type="date" name="dob" required><br><br>

        <!-- Gender -->
        <label for="gender">Gender:</label><br>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select><br><br>

        <!-- Education Qualification -->
        <label for="edu_qualification">Education Qualification:</label><br>
        <select name="edu_qualification" required>
            <option value="">Select Education Qualification</option>
            <option value="Primary (1st-5th)">Primary (Class 1–5)</option>
            <option value="Middle (6th-8th)">Middle (Class 6–8)</option>
            <option value="9th Pass">9th Pass</option>
            <option value="10th Pass">10th Pass (Secondary)</option>
            <option value="12th Pass">12th Pass (Higher Secondary)</option>
            <option value="ITI">ITI</option>
            <option value="Polytechnic Diploma">Polytechnic Diploma</option>
            <option value="BA">BA</option>
            <option value="BSc">BSc</option>
            <option value="BCom">BCom</option>
            <option value="BCA">BCA</option>
            <option value="BBA">BBA</option>
            <option value="BTech">BTech</option>
            <option value="BE">BE</option>
            <option value="MBBS">MBBS</option>
            <option value="MA">MA</option>
            <option value="MSc">MSc</option>
            <option value="MCom">MCom</option>
            <option value="MCA">MCA</option>
            <option value="MBA">MBA</option>
            <option value="MTech">MTech</option>
            <option value="PhD">PhD</option>
            <option value="Other">Other</option>
        </select><br><br>

        <!-- Address -->
        <label for="address">Address:</label><br>
        <textarea name="address" required></textarea><br><br>

        <!-- Admission Date -->
        <label for="admition_date">Admission Date:</label><br>
        <input type="date" name="admition_date" required><br><br>

        <button type="submit" name="create_student">Create Student</button>

    </form>

</body>
<script src="/feeManager/client/public/js/shortcut.js"></script>

</html>