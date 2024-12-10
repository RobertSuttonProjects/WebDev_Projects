<?php
//This script is used so javascript 
//can use the database


session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'new_game':
            require_once("Game.php");
            $game_name = htmlspecialchars($_POST['game_name']);
            $game_platform = htmlspecialchars($_POST['game_platform']);
            $is_starting = isset($_POST['is_starting']);
            newGame($game_name, $game_platform, $is_starting);
            break;
        case "show_games":
            require("Game.php");
            echo json_encode(getAllGames());
            break;
        case "show_games_started":
            require("Game.php");
            echo json_encode(getAllGamesStarted());
            break;
        case "show_games_completed":
            require("Game.php");
            echo json_encode(getAllGamesCompleted());
            break;
        case "start_game":
            require("Game.php");
            startGame($_POST["game_id"]);
            break;
        case "complete_game":
            require("Game.php");
            $id = $_POST["game_id"];
            completeGame($id);
            break;
        case "delete_game":
            require("Game.php");
            $id = $_POST["game_id"];
            deleteGame($id);
            break;
        default:
            echo "called for no reason";
    }
}
