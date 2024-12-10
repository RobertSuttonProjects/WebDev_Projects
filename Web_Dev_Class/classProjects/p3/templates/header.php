<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<html>
<div class="header">
    <a href="../../index.php" id="a-logo">
        <img src="images/spaceXLogo.jpg" alt="">
    </a>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="date.php">Date</a></li>
            <li><a href="playrps.php">RPS</a></li>
            <li><a href="repeater.php">Repeater</a></li>
            <li><a href="repeater.php">Repeater</a></li>
            <li><a href="repeater.php">Repeater</a></li>
            
            

        </ul>
    </nav>

    <div class="signout-panel">
        <a href="logout.php" id="a-username"> Hello <?php echo $_SESSION['username']?></a>
        <a href="logout.php" id="a-signout-button">Sign out</a>
    </div>


</html>
</div>