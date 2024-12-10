<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'UserAuthenticator.php';
    $auth = new UserAuthenticator();

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($auth->authenticate($username, $password))
        $auth->logUserIn($username);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="login-box">
        <div id="login-fail-box">
        </div>
        <div id="login-form">
            <form method="post">
                <p>
                <h3>Username</h3><input type="text" name="username" required> </p>
                <p>
                <h3>Password</h3><input type="password" name="password" required></p>
                <button type="submit" id="submit-button">Login</button>
                <p>Username: Programmer101</p>
                <p>Password: WebPrograms#101</p>
            </form>
        </div>
    </div>
    <?php require("templates/footer.php") ?>
</body>

</html>