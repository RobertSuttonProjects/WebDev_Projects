<!--
This page contains-

- User Signup Form
- Login button


-maybe features
-maybe make it a popup instead of a new page
-->
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require("classes/User.php");

    $username = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password_hash']);

    if (newUser($username, $email, $password)) {
        header("Location: index.php");
    } else {
        echo "Error Signing User Up";
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
        <h3>Signup</h3>
        <h3>Name</h3> <input type="email" name="name" required>
        <h3>Email</h3> <input type="text" name="email" required>
        <h3>Password</h3> <input type="password" name="password_hash" required>
        <input type="submit">
    </form>
    <a href="login.php" class="change-sign">Login</a>
    <?php require("templates/footer.php") ?>

</body>

</html>