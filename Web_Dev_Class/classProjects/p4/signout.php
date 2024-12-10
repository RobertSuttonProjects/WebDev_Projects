<!--
This page contains-

-radio button to sign out or not

-->
<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("classes/User.php");

    if ($_POST["signoutForm"] == "yes") {
        if (logUserOut()) {
            header("Location: index.php");
        } else {
            echo "Error Signing User Out";
        }
    }
    header("Location: index.php");
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
        <h3>Are You Sure You Wish To Signout?</h3>
        <h4>yes</h4><input type="radio" name="signoutForm" value="yes">
        <h4>no</h4><input type="radio" name="signoutForm" value="no">
        <input type="submit">
    </form>
    <?php require("templates/footer.php") ?>

</body>

</html>