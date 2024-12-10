<!--
This page contains-
- Header
- About
- Footer

- Can be signed out to view this page
-->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php 
    require("templates/header.php");  
    require("templates/about.php");    
    require("templates/contact.php");      
    require("templates/footer.php");
    ?>
</body>

</html>