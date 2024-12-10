<!--
This page contains-

- User Login Form
- Signup button

-maybe features
-maybe make it a popup instead of a new page
-->

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("classes/User.php");

    $username = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password_hash']);
    if (logUserIn($username, $password)) {
        header("Location: index.php");
    } else {
        echo "Error Signing In";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require("templates/header.php") ?>
    <form method="post">
        <h1>Login</h1>
        <h3>Email</h3> <input type="email" name="email" required>
        <h3>Password</h3> <input type="password" name="password_hash" required>
        <input type="submit">
    </form>
    <a href="signup.php" class="change-sign">Signup</a>
    <?php require("templates/footer.php") ?>

</body>

</html>