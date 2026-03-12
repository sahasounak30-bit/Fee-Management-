<?php
// db link fire
include_once __DIR__ . "/../../../server/config/db.php";
// fee create file link
include_once __DIR__ . "/../../../server/model/feeCreateServer.php";

if(isset($_GET["student_id"])){

    $id = $_GET["student_id"];

    $sql = "SELECT * FROM students WHERE id=?";
    $stmt = mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $student = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Fee</title>
</head>
<body>
    
    <h1>Create Fee</h1>
    <form action="/feeManager/server/model/feeCreateServer.php" method="post">
        <input type="text" name="name" value="<?php echo $student['first_name'];  ?>">
        <input type="number" style="display:none;" name="id" value="<?php echo $student["id"];  ?>">
        <input type="number" name="fee_amount" >
        <button name="set_fee">Set Fee</button>
    </form>
</body>
</html>