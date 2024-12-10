<?php
require("templates/header.php");

if(empty($_POST['rps'])){
    $_SESSION['rps_error'] = true;
    header('Location: playrps.php');
    exit();
}

$playerOption = $_POST['rps'];

[$enemyOption, $playerWon] = enemyPick(random_int(0, 2), $playerOption);

function enemyPick($option, $playerOption)
{
    switch ($option) {
            //ai wins
        case 1:
            if ($playerOption === "rock") {
                return ["paper", "Player Lost"];
            } else if ($playerOption === "paper") {
                return ["scissors", "Player Lost"];
            } else {
                return ["rock", "Player Lost"];
            }
            //ai lost
        case 2:
            if ($playerOption === "rock") {
                return ["scissors", "Player Won"];
            } else if ($playerOption === "paper") {
                return ["rock", "Player Won"];
            } else {
                return ["paper", "Player Won"];
            }
            //ai win
        default:
            return [$playerOption, "Tied"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock Paper Scissors Result</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="rps-display">
        <?php
        echo
        '<div id="player-score-panel">
            <p> Player: ' . $playerOption . " |" . ' </p>
            <p> Ai: ' . $enemyOption . " |" . ' </p>
            <p>' . $playerWon . " |" . '</p>
         </div>'

        ?>
        <a href="playrps.php" id="rps-play-again">Play Again</a>
    </div>
    <?php require("templates/footer.php") ?>




</body>

</html>