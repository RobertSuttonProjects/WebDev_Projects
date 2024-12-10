<!--
This page contains-

-if user is signed in shows name
-otherwise shows Login
-->
<?php
if (isset($_SESSION['user-id'])) {
    echo
    "
    <a href='signout.php' id='currentUser' class='nav_button' >" . $_SESSION['user-name'] . "</a>
    ";
} else {
    echo
    "
    <a href='login.php' id='currentUser' class='nav_button' >Login</a>
    ";
}
?>