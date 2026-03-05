<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin Page</title>
</head>

<body>
    <h1>Sign In</h1>
    <form action="/feeManager/server/controller/signInServer.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="pass" placeholder="Password">
        <input type="text" name="qna" placeholder="QNA">
        <button type="submit" name="signIn">Sign In</button>
    </form>
</body>

</html>