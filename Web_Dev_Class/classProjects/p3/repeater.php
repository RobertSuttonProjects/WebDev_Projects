<?php
$randomNum = random_int(0, 500);
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
    <?php require("templates/header.php") ?>

    <?php
    for ($i = 0; $i < $randomNum; $i++) {
        echo "This page should display a sentence of your choosing a random number of times (lets limit to 500
            repeats max). The number of times the sentence appears should be different every time they visit 
            this page. Requires login.
            ss";
    }
    ?>

    <?php require("templates/footer.php") ?>
</body>

</html>