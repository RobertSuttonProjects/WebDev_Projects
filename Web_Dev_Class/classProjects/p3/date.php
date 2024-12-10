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
    $time = date("m/d/Y g:i A");
    echo $time;
    ?>
    
    <?php require("templates/footer.php") ?>
</body>

</html>