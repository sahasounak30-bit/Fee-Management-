<?php
// fetch file link
include_once __DIR__ . "/../../../server/model/studentFetchServer.php";
// fee create file link
include_once __DIR__ . "/../../../server/model/feeCreateServer.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Entry</title>
</head>
<body>
    <h1>Fee Page</h1>

    <?php if(!empty($_SESSION["err"])){
        
        foreach($_SESSION["err"] as $err){
            echo $err;
        }

        unset($_SESSION["err"]);
    }
    
    if(!empty($_SESSION[ 'success' ])){

        foreach($_SESSION[ 'success' ] as $success){
            echo $success;
        }

        unset($_SESSION["success"]);

    }
    ?>

    <?php if (!empty($row)) { ?>
            <?php foreach ($row as $r) { ?>

                    <!-- student card -->
                    <div class="std_card">
                        <div class="header">
                            <h2><?php echo $r["first_name"] . " " . $r["last_name"]; ?></h2>
                        </div>
                            <a href="/feeManager/client/views/page/feeCreate.php?student_id=<?php echo $r['id']; ?>">Create Fee</a>
                        </div>
                    </div>

            <?php } ?>
    <?php } ?>

    <a href="/feeManager/client/views/page/feeEntry.php">Fee Entry</a>
</body>
</html>