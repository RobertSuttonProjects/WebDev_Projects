<?php require("templates/header.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="rps-description">
        <?php
        $error = isset($_SESSION['rps_error']);
        if ($error) {
            echo'<p>ERROR! Please press rock paper or scissors and then press play!</p>';
            unset($_SESSION['rps_error']);
        } else {
            echo '<p>Select Rock Paper or Scissors and then press play</p>';
        }
        ?>

        
    </div>
    <form action="rps.php" method="post" id="rps-content">
        <label class="rps-select">
            <input type="radio" name="rps" value="rock" id="rock">
            <h3>Rock</h3>
        </label>

        <label class="rps-select">
            <input type="radio" name="rps" value="paper" id="paper">
            <h3>Paper</h3>
        </label>

        <label class="rps-select">
            <input type="radio" name="rps" value="scissor" id="scissor">
            <h3>Scissors</h3>
        </label>

        <button type="submit" id="play-rps" class="rps-select">
            <h3>Play Again</h3>
        </button>
    </form>
    <?php require("templates/footer.php") ?>
</body>

</html>