<!--
This CLASS contains-

- LogUserIn(Email, Password)
- LogUserOut()
- isLoggedIn()
- newUser(Email, Name, Password)
- isNewEmail(Email)
- getUserID
- getUserName

-maybe features
-change username
-change password
-->

<?php

function logUserIn($email, $password)
{
    require("Database.php");
    $sql = "SELECT * FROM user WHERE email = :email";
    $query = $dbh->prepare($sql);
    $query->bindValue(":email", $email);
    $success = $query->execute();
    if ($success) {
        $user = $query->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user["password_hash"])) {
            $_SESSION['user-id'] = $user["user_id"];
            $_SESSION['user-name'] = $user["name"];
            return true;
        }
    }
    return false;
}
function logUserOut()
{
    session_unset();
    return session_destroy();
    }
function isLoggedIn()
{
    return isset($_SESSION["user-id"]);
}

function newUser($name, $email, $password)
{
    if (isNewEmail($email)) {
        require("Database.php");
        $sql = "INSERT INTO `user` (`name`, `email`, `password_hash`)
        VALUES (:name, :email, :password)";

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = $dbh->prepare($sql);
        $query->bindValue(":name", $name);
        $query->bindValue(":email", $email);
        $query->bindValue(":password", $hashedPassword);
        $success = $query->execute();
        if ($success) {
            return logUserIn($email, $password);
        }
    }
    return false;
}
function isNewEmail($email)
{
    require("Database.php");
    $sql = "SELECT `email` FROM `user` WHERE `email` = :email";
    $query = $dbh->prepare($sql);
    $query->bindValue(":email", $email);
    $success = $query->execute();
    if ($success) {
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user === false;
    }
    echo "ERROR";
    return false;
}
function getUserID($email, $password)
{
    return $_SESSION["user-id"];
}
function getUserName($email, $password)
{
    return $_SESSION["user-name"];
}
