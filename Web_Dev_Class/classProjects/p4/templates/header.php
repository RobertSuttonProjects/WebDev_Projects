<!--
This page contains-

-Navbar
-Login/User button

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav>
        <div id="topRow">
            <img src="assets/images/Logo.png" alt="">
            <div id="navList">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="games.php">Games</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
                <a href="games.php" class="phoneCSS">Games</a>
                <!--We need login top right of navbar-->
                <?php require("navbarUser.php") ?>
            </div>
        </div>
        <div id="title">
            <h1>Video Game Backlogs</h1>
            <h3>Where Games Are Saved and Never Played</h3>
        </div>
    </nav>
</body>

</html>