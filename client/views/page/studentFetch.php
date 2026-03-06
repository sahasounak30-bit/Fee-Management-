<?php
// fetch file link
include_once __DIR__ . "/../../../server/model/studentFetchServer.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students</title>
</head>

<body>
    <h1>All Students</h1>
    <?php if (!empty($row)) { ?>
        <?php foreach ($row as $r) { ?>

            <!-- student card -->
            <div class="std_card">
                <div class="header">
                    <h2><?php echo $r["first_name"] . " " . $r["last_name"]; ?></h2>
                </div>
            </div>
            <div class="studentInfo">
                <p><strong>Phone:</strong> <?php echo $r['phone']; ?></p>
                <p><strong>DOB:</strong> <?php echo $r['dob']; ?></p>
                <p><strong>Gender:</strong> <?php echo $r['gender']; ?></p>
                <p><strong>Admission:</strong> <?php echo $r['admition_date']; ?></p>
            </div>
            <div class="studentActions">
                <button class="viewBtn">View</button>
                <button class="deleteBtn">Delete</button>
            </div>

        <?php } ?>
    <?php } else { ?>
        <?php echo $err; ?>
    <?php } ?>
</body>

</html>