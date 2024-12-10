<?php
require_once "UserAuthenticator.php";

$auth = new UserAuthenticator();
$auth ->logout();
echo "Signout Page";
$auth ->redirectToPage("login.php");
?>