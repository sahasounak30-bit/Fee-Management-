<?php
// session start
session_start();

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

    <?php if (!empty($_SESSION["err"])) { ?>
            <?php foreach ($_SESSION["err"] as $err) { ?>
                    <?php echo $err; ?>
            <?php } ?>
            <?php unset($_SESSION["err"]); ?>
    <?php } ?>

    <?php if (!empty($_SESSION["success"])) { ?>
            <?php echo $_SESSION["success"]; ?>
            <?php unset($_SESSION["success"]); ?>
    <?php } ?>

    <?php if (!empty($row)) { ?>
            <?php foreach ($row as $r) { ?>

                    <!-- student card -->
                    <div class="std_card">
                        <div class="header">
                            <h2><?php echo $r["first_name"] . " " . $r["last_name"]; ?></h2>
                        </div>
                        <div class="studentInfo">
                            <p><strong>Phone:</strong> <?php echo $r['phone']; ?></p>
                            <p><strong>DOB:</strong> <?php echo $r['dob']; ?></p>
                            <p><strong>Gender:</strong> <?php echo $r['gender']; ?></p>
                            <p><strong>Admission:</strong> <?php echo $r['admition_date']; ?></p>
                        </div>
                        <div class="studentActions">
                            <button class="viewBtn" name="viewBtn">View</button>
                            <form action="/feeManager/server/model/studentDeleteServer.php" method="post">
                                <input type="text" style="display: none;" name="id" value="<?php echo $r["id"]; ?>">
                                <button class="deleteBtn" name="deleteBtn">Delete</button>
                            </form>
                            <form action="/feeManager/server/model/studentUpdateServer.php" method="post">
                                <input type="text" style="display: none;" name="id" value="<?php echo $r["id"]; ?>">
                                <button class="updateBtn" name="updateBtn">Update</button>
                            </form>
                        </div>
                    </div>

            <?php } ?>
    <?php } else { ?>
            <?php echo $err; ?>
    <?php } ?>
</body>

</html>