<?php
include_once __DIR__ . "/../../../server/model/studentUpdateServer.php";

if (empty($_SESSION["student"])) {
    header("Location: /feeManager/client/views/page/studentFetch.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Update</title>
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
    <h1>Student Update</h1>

    <form action="/feeManager/server/model/studentUpdateServer.php" method="post">

        <input type="text" style="display: none;" name="id" value="<?php echo $_SESSION["student"]["id"]; ?>">

        <!-- First Name -->
        <label for="first_name">First Name:</label><br>
        <input type="text" name="first_name" required value="<?php echo $_SESSION["student"]['first_name']; ?>"><br><br>

        <!-- Last Name -->
        <label for="last_name">Last Name:</label><br>
        <input type="text" name="last_name" required value="<?php echo $_SESSION["student"]['last_name']; ?>"><br><br>

        <!-- Phone -->
        <label for="phone">Phone:</label><br>
        <input type="tel" name="phone" required value="<?php echo $_SESSION["student"]['phone']; ?>"><br><br>

        <!-- Date of Birth -->
        <label for="dob">Date of Birth:</label><br>
        <input type="date" name="dob" required value="<?php echo $_SESSION["student"]['dob']; ?>"><br><br>

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
        <select name="edu_qualification" required >
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
        <textarea name="address" required ><?php echo $_SESSION["student"]['address']; ?></textarea><br><br>

        <!-- Admission Date -->
        <label for="admition_date">Admission Date:</label><br>
        <input type="date" name="admition_date" required value="<?php echo $_SESSION["student"]['admition_date']; ?>"><br><br>

        <button type="submit" name="update_student">Update Student</button>

    </form>

</body>

</html>